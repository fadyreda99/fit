<?php

namespace App\Http\Requests\FoodType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodTypeRequest extends FormRequest
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
            'type_id'=>'required|exists:food_types,id',
            'type'=>'required|string'
        ];
    }
}
