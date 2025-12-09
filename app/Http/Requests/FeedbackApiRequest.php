<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FeedbackApiRequest extends FormRequest
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
            'title' => 'required|string',
            'content' => 'required|string',
            'url' => 'sometimes|nullable|url',
            'type' => [
                'required',
                Rule::in(['problem', 'feedback', 'bug', 'suggestion', 'feature request']),
            ],
            'g-recaptcha-response' => 'required|recaptcha',
        ];

        $unauthedUserRules = [
            'user_name' => 'required|string',
            'user_email' => 'required|email',
        ];

        $rules = $generalRules;

        if (! Auth::user()) {
            $rules = array_merge($unauthedUserRules, $generalRules);
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
            'user_name.required' => 'Name is required',
            'user_email.required' => 'Email is required',
            'user_name.string' => 'Your name must be a string',
            'user_email.email' => 'Your email must be a valid email address',
            'title.required' => 'Title is required',
            'content.required' => 'Message is required',
            'title.string' => 'Your title is not formatted correctly',
            'content.string' => 'Your message is not formatted correctly',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification',
            'g-recaptcha-response.recaptcha' => 'reCAPTCHA verification failed',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
