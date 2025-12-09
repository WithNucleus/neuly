<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequestSubmitRequest extends FormRequest
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
            'entity_type' => 'required|string',
            'is_update' => 'sometimes|nullable|boolean',
            'to_update_id' => 'sometimes|nullable|integer',
            'g-recaptcha-response' => 'required|recaptcha',
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
            'entity_type.required' => 'Entity type is required',
            'entity_type.string' => 'Entity type must be a string',
            'to_update_id.integer' => 'To update ID must be an integer',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification',
            'g-recaptcha-response.recaptcha' => 'reCAPTCHA verification failed',
        ];
    }
}
