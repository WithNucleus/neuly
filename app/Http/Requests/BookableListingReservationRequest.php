<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookableListingReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required_without:phone|nullable|email',
            'phone' => 'required_without:email',
            'date' => 'nullable|date',
            'message' => 'nullable|string',
            'bookable_listing_id' => 'required|integer',
            'number_of_guests' => 'nullable|integer'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required_without' => 'Email or phone is required',
            'phone.required_without' => 'Your info is safe with us',
            'bookable_listing_id.required' => 'Something went wrong. Please email support@neuly.com',
            'bookable_listing_id.integer' => 'Something is wrong. Please email support@neuly.com',
        ];
    }
}
