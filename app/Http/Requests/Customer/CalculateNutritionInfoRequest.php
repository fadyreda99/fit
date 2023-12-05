<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CalculateNutritionInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'=>'required|numeric|exists:users,id',
            'game'=>'required',
            'activity_factor'=>'required|numeric',
            'protien_factor'=>'required|numeric',
            'program_type'=>'required|in:bulking,lose_weight,cutting',
            'kcals_increasing_decreasing'=>'required|numeric'
        ];
    }
}
