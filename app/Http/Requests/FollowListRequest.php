<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowListRequest extends FormRequest
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
        if ($this->route()->hasParameter('follow_list')) {
            $id = $this->route()->parameter('follow_list');

            return [
                'name' => 'required|min:3|max:255|unique:follow_lists,name,'.$id.',id,user_id,'.auth()->user()->id,
                'slug' => 'required|min:3|max:255|unique:follow_lists,slug,'.$id.',id,user_id,'.auth()->user()->id,
            ];
        }

        return [
            'name' => 'required|min:3|max:255|unique:follow_lists,name,NULL,id,user_id,'.auth()->user()->id,
        ];
    }
}
