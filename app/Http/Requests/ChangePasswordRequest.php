<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'new_password' => 'required|same:new_password_confirmation',
            'new_password_confirmation' => 'required',
            'password' => 'required|different:new_password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'new_password.required' => 'You have to enter your new password.',
            'new_password_confirmation.required' => 'You have to confirm your new password.',
            'new_password.same' => 'Your new password did not match your confirmation.',
            'password.required' => 'You need to validate yourself by entering your current password.',
            'password.different' => 'You should choose an unused password if you want to change it.',
        ];
    }
}
