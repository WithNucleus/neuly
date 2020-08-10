<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeMailRequest extends FormRequest
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
            'new_email' => 'required|same:new_email_confirmation|unique:users,email',
            'new_email_confirmation' => 'required',
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
            'new_email.required' => 'You have to enter your new email.',
            'new_email_confirmation.required' => 'You have to confirm your new email.',
            'new_email.same' => 'Your new email did not match your confirmation.',
            'new_email.unique' => 'Your new email is already in use.',
            'password.required' => 'You need to validate yourself by entering your current password.',
            'password.different' => 'You should choose an unused email if you want to change it.',
        ];
    }
}
