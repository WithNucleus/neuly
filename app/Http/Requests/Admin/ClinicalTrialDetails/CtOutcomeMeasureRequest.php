<?php

namespace App\Http\Requests\Admin\ClinicalTrialDetails;

use Illuminate\Foundation\Http\FormRequest;

class CtOutcomeMeasureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check() && backpack_user()->can('edit clinical trials');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|min:5|max:255|unique:ct_outcome_measures,value,' . $this->get('id'),
        ];
    }
}
