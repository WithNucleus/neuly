<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class MetricRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
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
            'name' => 'required|min:5|max:255',
            'date' => 'required|date',
            'type' => 'required',
            'organizations' => 'required|integer',
            'people' => 'required|integer',
            'investors' => 'required|integer',
            'events_upcoming' => 'required|integer',
            'events_past' => 'required|integer',
            'events_total' => 'required|integer',
            'jobs_total' => 'required|integer',
            'jobs_open' => 'required|integer',
            'jobs_archived' => 'required|integer',
            'total_media_items' => 'required|integer',
            'news' => 'required|integer',
            'articles' => 'required|integer',
            'images' => 'required|integer',
            'videos' => 'required|integer',
            'mixed_media' => 'required|integer',
            'podcasts' => 'required|integer',
            'books' => 'required|integer',
            'patent_filings' => 'required|integer',
            'courses' => 'required|integer',
            'patents' => 'required|integer',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
