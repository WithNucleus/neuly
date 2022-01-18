<?php

namespace App\Http\Controllers;

class ExternalScriptController extends Controller
{
    public function getSearchModalTemplate()
    {
        return response()->view('external-scripts.embed-search.modal');
    }
}
