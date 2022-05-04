<?php

namespace App\Http\Requests\Api;

use App\Models\Job;
use Illuminate\Validation\Rule;

class JobRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'owner_id' => 'required|integer',
            'owner_type' => [
                'required',
                Rule::in(array_keys(Job::OWNER_TYPES)),
            ],
            'job_title' => 'required|min:5|max:255',
            'job_description' => 'required',
            'posted_date' => 'required|date',
            'employment_type' => [
                'required',
                Rule::in(Job::EMPLOYMENT_TYPE),
            ],
            'status' => [
                'nullable',
                Rule::in(Job::STATUS_VALUES),
            ],
        ];
    }
}
