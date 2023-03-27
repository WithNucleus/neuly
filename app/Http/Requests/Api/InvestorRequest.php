<?php

namespace App\Http\Requests\Api;

use App\Models\Investor;
use Illuminate\Validation\Rule;

class InvestorRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3|max:255|unique:investors,name,'.$this->route('id'),
            'website' => 'max:255',
            'type' => [
                'nullable',
                Rule::in(Investor::TYPE),
            ],
        ];

        return $this->updateRulesForPutMethod($rules);
    }
}
