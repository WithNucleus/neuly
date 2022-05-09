<?php

namespace App\Http\Requests\Api;

class ResearchRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:5|max:255|unique:research,name,' . $this->route('id'),
            'link' => 'max:500',
            'publish_date' => 'nullable|date',
            'publication_info' => 'max:500',
        ];

        return $this->updateRulesForPutMethod($rules);
    }
}
