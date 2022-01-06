<?php

namespace App\Http\Controllers;

class ExternalScriptController extends Controller
{
    public function embedSearch()
    {
        return response()
            ->view('external-scripts.embed-search')
            ->header('Content-Type', 'application/javascript');
    }
}
