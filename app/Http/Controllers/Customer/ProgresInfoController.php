<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ProgressInfoRequest;
use App\Http\Resources\Customer\ProgressInfoResource;
use App\Models\ProgressInfo;
use App\Models\User;
use App\Traits\TransactionsTrait;
use Illuminate\Http\Request;
use Symfony\Contracts\Translation\TranslatorTrait;

class ProgresInfoController extends Controller
{
    use TransactionsTrait;


    public function progressInfo(ProgressInfoRequest $request){
        $user = User::where('id', $request->user_id)->first();
        $gender = $user->basicInfo->gender;
        $type = $user->nutritionalInfo->program_type;
        $current_weight = $request->current_weight;
        $current_body_fat = $request->current_body_fat;
        $gender_fat = $this->getGenderFat($gender);
        $current_excess_fat = $this->excessFat($current_body_fat, $gender_fat);
        $current_lbm = $this->currentLbm($current_weight, $current_excess_fat);
        $current_ffm = $this->currentFfm($current_weight, $current_body_fat);

        $progressInfo = ProgressInfo::create([
            'user_id'=>$user->id,
            'current_weight'=>$current_weight,
            'current_body_fat'=>$current_body_fat,
            'current_excess_fat'=>$current_excess_fat,
            'current_LBM'=>$current_lbm,
            'current_FFM'=>$current_ffm,
        ]);

        return new ProgressInfoResource($progressInfo);

    }   
}
