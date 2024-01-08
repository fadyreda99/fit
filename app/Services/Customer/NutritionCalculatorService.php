<?php

namespace App\Services\Customer;

use App\Models\CustomerMacros;
use App\Models\CustomerNutritionalInfos;
use App\Models\ProgressInfo;
use App\Models\User;
use App\Traits\TransactionsTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class NutritionCalculatorService
{
    use TransactionsTrait;

    private $fats_to_eat;
    private $sign;
    private $gender_fat;
    private $excess_fat;
    private $gender;

    public function calculate($request)
    {
        $kcals_I_D = $request->kcals_increasing_decreasing; //kcals to increase for bulcking or decrease for lose weight or cutting 
        $user = User::whereId($request->user_id)->first();
        $this->gender = $user->basicInfo->gender;
        $program_type = $request->program_type;

        if ($program_type == "bulking") {
            $this->fats_to_eat = 30;
            $this->sign = "+";
            $this->gender_fat = $this->getGenderFat($this->gender);
            $this->excess_fat = 0;
        } elseif ($program_type == "lose_weight") {
            $this->fats_to_eat = 30;
            $this->sign = "-";
            $this->gender_fat = $this->getGenderFat($this->gender);
            $this->excess_fat = $this->excessFat($user->basicInfo->body_fat, $this->gender_fat);
        } elseif ($program_type == "cutting") {
            $this->fats_to_eat = 10;
            $this->sign = "-";
            $this->gender_fat = 0;
            $this->excess_fat = $this->excessFat($user->basicInfo->body_fat, $this->gender_fat);
        }

        $result = $this
            ->handleCycle(
                $user->basicInfo->weight,
                $this->excess_fat,
                $user->basicInfo->body_fat,
                $this->gender,
                $request->activity_factor,
                $kcals_I_D,
                $this->sign,
                $request->protien_factor,
                $this->fats_to_eat
            );

        $data = json_decode($result->getContent(), true);

        $nutrtionalInfo = CustomerNutritionalInfos::where('user_id', $request->user_id)->first();
        if ($nutrtionalInfo) {
            $game = $nutrtionalInfo->game;
        }

        DB::beginTransaction();
        try {
            $customer_nutritional_info = CustomerNutritionalInfos::updateOrCreate(
                ['user_id' => $request->user_id],
                [
                    'excess_fat' => $this->excess_fat,
                    'FFM' => $data['FFM'],
                    'LBM' => $data['LBM'],
                    'game' => $request->game ? $request->game : $game,
                    'activity_factor' => $request->activity_factor,
                    'protien_factor' => $request->protien_factor,
                    'BMR' => $data['BMR'],
                    'AMR' => $data['AMR'],
                    'program_type' => $request->program_type
                ]
            );

            $customer_macros = CustomerMacros::updateOrCreate(
                ['nutritional_id' => $customer_nutritional_info->id],
                [
                    'target_amr' => $data['target_amr'],
                    'protien_in_grams' => $data['protien_in_grams'],
                    'protien_in_kcals' => $data['protien_in_kcals'],
                    'carb_in_grams' => $data['carb_in_grams'],
                    'carb_in_kcals' => $data['carb_in_kcals'],
                    'fat_in_grams' => $data['fat_in_grams'],
                    'fat_in_kcals' => $data['fat_in_kcals']
                ]
            );

            $progressInfo = ProgressInfo::create([
                'user_id' => $user->id,
                'current_weight' => $user->basicInfo->weight,
                'current_body_fat' => $user->basicInfo->body_fat,
                'current_excess_fat' => $this->excess_fat,
                'current_LBM' => $data['LBM'],
                'current_FFM' => $data['FFM'],
            ]);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
