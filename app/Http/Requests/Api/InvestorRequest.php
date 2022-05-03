<?php

namespace App\Http\Requests\Api;

class InvestorRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255|unique:investors,name,' . $this->get('id'),
            'website' => 'max:255',
            'type' => 'max:255'
        ];
    }
}
