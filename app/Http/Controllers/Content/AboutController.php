<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Metas;

class AboutController extends Controller
{

    public function index(Request $request) {

    	// Metas
        $metas = Metas::fromPage($request->path());

    	return view('content.about.index', compact('metas'));

    }
}
