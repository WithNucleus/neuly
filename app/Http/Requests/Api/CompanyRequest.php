<?php

namespace App\Http\Requests\Api;

class CompanyRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:companies,name,' . $this->get('id'),
        ];
    }
}
