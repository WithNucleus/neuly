<?php

namespace App\Http\Requests\Api;

class ClinicaltrialRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:255',
            'nct_number' => 'required|min:3|max:255',
            'acronym' => 'max:255',
            'status' => 'max:255',
            'study_results' => 'max:255',
            'gender' => 'max:255',
            'age' => 'max:255',
            'phases' => 'max:255',
            'phase_integer' => 'nullable|integer',
            'enrollment' => 'max:255',
            'funded_bys' => 'max:255',
            'study_type' => 'max:255',
            'other_ids' => 'max:255',
            'start_date' => 'nullable|date',
            'primary_completion_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'first_posted' => 'nullable|date',
            'results_first_posted' => 'nullable|date',
            'last_update_posted' => 'nullable|date',
            'study_url' => 'max:255',
            'min_age' => 'nullable|integer',
            'max_age' => 'nullable|integer',
        ];
    }
}
