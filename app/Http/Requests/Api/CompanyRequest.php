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
        $rules = [
            'name' => 'required|min:3|max:255|unique:companies,name,' . $this->route('id'),
            'ownership' => 'max:255',
            'website' => 'max:255',
            'ticker_symbol' => 'max:255',
            'founded_date' => 'nullable|date',
            'valuation' => 'numeric',
            'total_funding_amount' => 'numeric',
            'last_funding_date' => 'nullable|date',
            'number_employees' => 'numeric',
            'facebook' => 'max:255',
            'instagram' => 'max:255',
            'linkedin' => 'max:255',
        ];

        return $this->updateRulesForPutMethod($rules);
    }
}
