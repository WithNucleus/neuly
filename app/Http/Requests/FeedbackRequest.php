<?php

namespace App\Http\Requests;

use App\Models\Feedback;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FeedbackRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in(Feedback::TYPES),
            ],
        ];

        $unauthedUserRules = [
            'user_name' => 'required|string',
            'user_email' => 'required|email',
        ];

        $rules = $generalRules;

        if (! Auth::user()) {
            $rules = array_merge($generalRules, $unauthedUserRules);
        }

        return $rules;
    }
}
