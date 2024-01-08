<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBasicAndNutretionalInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>'required|exists:users,id',
            'weight'=>'required',
            'body_fat'=>'required',
            // 'game'=>'required',
            'activity_factor'=>'required',
            'protien_factor'=>'required',
            'program_type' =>'required|in:lose_weight,bulking,cutting',
            'kcals_increasing_decreasing'=>'required'
        ];
    }
}
