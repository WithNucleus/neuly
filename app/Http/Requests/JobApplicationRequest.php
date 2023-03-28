<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'resume' => 'required|mimes:pdf|max:3000',
            'cover_letter' => 'required|mimes:pdf|max:3000',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'resume.required' => 'Resume is required',
            'resume.max' => 'Resume must be 3 MB or less',
            'cover_letter' => 'Cover letter is required',
            'cover_letter.max' => 'Cover letter must be 3 MB or less',
        ];
    }
}
