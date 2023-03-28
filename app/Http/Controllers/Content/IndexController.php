<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return view('discover.index.pubco');
    }
}
