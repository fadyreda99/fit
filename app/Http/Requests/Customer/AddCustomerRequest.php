<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class AddCustomerRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'phone'=>'required|unique:users,phone',
            'weight'=>'required|numeric',
            'height'=>'required|numeric',
            'body_fat'=>'required|numeric',
            'birth_date'=>'required|date_format:Y-m-d',
            'city'=>'required',
            'nationality'=>'required',
            'gender'=>'required|in:male,female',
            'image'=>'required|image|mimes:jpeg,png,jpg,'
        ];
    }
}
