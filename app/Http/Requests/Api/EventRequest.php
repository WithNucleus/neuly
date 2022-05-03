<?php

namespace App\Http\Requests\Api;

class EventRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:255',
            'start_date' => 'required|date',
            'end_date' => 'date'
        ];
    }
}
