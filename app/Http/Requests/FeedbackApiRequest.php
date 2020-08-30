<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
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
            'title' => 'string|required',
            'content' => 'string|required',
            'type' => [
                'required',
                Rule::in(['problem', 'feedback', 'bug', 'suggestion', 'feature request'])
            ]
        ];

        $unauthedUserRules = [
            'user_name' => 'string|required',
            'user_email' => 'email|required'
        ];

        $rules = $generalRules;

        if(!Auth::user()) {
            $rules = array_merge($generalRules, $unauthedUserRules);
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
