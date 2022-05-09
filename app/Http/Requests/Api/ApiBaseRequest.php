<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ApiBaseRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasWritePermission();
    }

    protected function updateRulesForPutMethod($rules)
    {
        if (request()->method() === 'PUT') {
            foreach ($rules as $field => $rule) {
                if (is_array($rule) && $requiredKey = array_search('required', $rule)) {
                    $rules[$field][$requiredKey] = 'nullable';
                } else {
                    $rules[$field] = str_replace('required', 'nullable', $rule);
                }
            }
        }

        return $rules;
    }
}
