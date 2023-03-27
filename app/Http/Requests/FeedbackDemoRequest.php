<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FeedbackDemoRequest extends FormRequest
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
            'organization' => 'required',
            'job_title' => 'required',
            'content' => 'required',
        ];

        $unauthedUserRules = [
            'name' => 'required',
            'email' => 'required|email',
        ];

        $rules = $generalRules;

        if (! Auth::user()) {
            $rules = array_merge($unauthedUserRules, $generalRules);
        }

        return $rules;
    }
}
