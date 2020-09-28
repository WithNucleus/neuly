<?php

namespace App\Http\Requests\Admin\Import;

use Illuminate\Foundation\Http\FormRequest;

class BatchImagesUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'entity_type' => 'required',
            'csv' => 'required|mimes:csv,txt',
            'images' => 'required|mimes:zip',
        ];
    }
}
