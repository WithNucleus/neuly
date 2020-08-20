<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class BookmarkListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // rules for update action
        if ($this->route()->hasParameter('id')) {
            $id = $this->route()->parameter('id');

            return [
                'name' => 'required|min:3|max:255|unique:bookmark_lists,name,' . $id . ',id,user_id,' . auth()->user()->id,
                'slug' => 'required|min:3|max:255|unique:bookmark_lists,slug,' . $id . ',id,user_id,' . auth()->user()->id,
                'description' => 'max:255',
            ];
        }

        return [
            'name'        => 'required|min:3|max:255|unique:bookmark_lists,name,NULL,id,user_id,' . auth()->user()->id,
            'description' => 'max:255',
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
