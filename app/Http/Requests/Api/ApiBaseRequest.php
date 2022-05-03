<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ApiBaseRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasWritePermission();
    }
}
