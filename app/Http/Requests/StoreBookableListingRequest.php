<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookableListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('bookable_listings')->ignore($this->id),
            ],
            'bookable_id' => 'required',
            'type' => 'required',
            'url' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'location_name' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'description' => 'required',
            'focus' => 'nullable',
            'virtual' => 'nullable',
        ];
    }
}
