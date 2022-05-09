<?php

namespace App\Http\Requests\Api;

use App\Enum\MediaTypes;
use Illuminate\Validation\Rule;

class MediaItemRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'media_type' => [
                'required',
                Rule::in(MediaTypes::MEDIA_TYPES),
            ],
            'date' => 'required|date',
            'url' => 'nullable|url',
            'icon_url' => 'nullable|url',
        ];

        return $this->updateRulesForPutMethod($rules);
    }
}
