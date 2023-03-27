<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class StripBackpackRequest
{
    public function __invoke(Request $request): array
    {
        return $request->except('_token', '_method', '_http_referrer', '_current_tab', '_save_action');
    }
}
