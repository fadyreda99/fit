<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CalculateNutritionInfoRequest;
use App\Models\CustomerMacros;
use App\Models\CustomerNutritionalInfos;
use App\Models\User;
use App\Services\Customer\NutritionCalculator;
use App\Traits\TransactionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculateNutritionalInfoController extends Controller
{
    use TransactionsTrait;

    private $fats_to_eat;
    private $sign;
    private $gender_fat;
    private $excess_fat;
    private $gender;

    public function calculate(CalculateNutritionInfoRequest $request)
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

        DB::beginTransaction();
        $customer_nutritional_info = CustomerNutritionalInfos::create([
            'user_id' => $request->user_id,
            'excess_fat' => $this->excess_fat,
            'FFM' => $data['FFM'],
            'LBM' => $data['LBM'],
            'game' => $request->game,
            'activity_factor' => $request->activity_factor,
            'protien_factor' => $request->protien_factor,
            'BMR' => $data['BMR'],
            'AMR' => $data['AMR'],
            'program_type' => $request->program_type
        ]);

        $customer_macros = CustomerMacros::create([
            'nutritional_id' => $customer_nutritional_info->id,
            'target_amr' => $data['target_amr'],
            'protien_in_grams' => $data['protien_in_grams'],
            'protien_in_kcals' => $data['protien_in_kcals'],
            'carb_in_grams' => $data['carb_in_grams'],
            'carb_in_kcals' => $data['carb_in_kcals'],
            'fat_in_grams' => $data['fat_in_grams'],
            'fat_in_kcals' => $data['fat_in_kcals']
        ]);

        DB::commit();
        // return $customer_nutritional_info->with('macros');
        return $customer_macros;
    }
}