<?php

namespace App\Http\Requests\Api;

class PersonRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'website' => 'max:255',
            'facebook' => 'max:255',
            'instagram' => 'max:255',
            'linkedin' => 'max:255',
            'twitter' => 'max:255',
            'google_scholar' => 'max:255',
            'published_works' => 'max:255',
            'byline' => 'max:255',
            'job_type' => 'max:255',
        ];
    }
}
