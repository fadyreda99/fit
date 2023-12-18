<?php

namespace App\Http\Requests\FollowUps;

use Illuminate\Foundation\Http\FormRequest;

class AddFollowUpRequest extends FormRequest
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
            'follow_up_date'=>'required|date|date_format:Y-m-d',
            // 'status'=>'required|in:pending,followed_up',
        ];
    }
}
