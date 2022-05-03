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
        return [
            'name' => 'required|min:5|max:255|unique:research,name,' . $this->get('id'),
            'link' => 'max:500',
            'publish_date' => 'date',
            'publication_info' => 'max:500',
        ];
    }
}
