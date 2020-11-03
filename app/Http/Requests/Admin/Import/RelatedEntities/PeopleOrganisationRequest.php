<?php

namespace App\Http\Requests\Admin\Import\RelatedEntities;

use Illuminate\Foundation\Http\FormRequest;

class PeopleOrganisationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'csv' => 'required|mimes:csv,txt',
        ];
    }
}
