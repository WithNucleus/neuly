<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ListingRequestFinishRequest extends FormRequest
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
        $generalRules = [
            'entity_type' => 'required|string',
            'comment' => 'sometimes|nullable|string',
            'to_update_id' => 'sometimes|nullable|integer',
            'g-recaptcha-response' => 'required|recaptcha',
        ];

        $unauthedUserRules = [
            'applicant_name' => 'required|string',
            'applicant_email' => 'required|email',
        ];

        $rules = $generalRules;

        if (!Auth::user()) {
            $rules = array_merge($generalRules, $unauthedUserRules);
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'entity_type.required' => 'Entity type is required',
            'entity_type.string' => 'Entity type must be a string',
            'applicant_name.required' => 'Name is required',
            'applicant_email.required' => 'Email is required',
            'applicant_name.string' => 'Your name must be a string',
            'applicant_email.email' => 'Your email must be a valid email address',
            'comment.string' => 'Your comment must be a string',
            'to_update_id.integer' => 'To update ID must be an integer',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification',
            'g-recaptcha-response.recaptcha' => 'reCAPTCHA verification failed',
        ];
    }
}
