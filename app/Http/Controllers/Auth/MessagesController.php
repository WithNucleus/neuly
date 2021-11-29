<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /* Success for Registering Page */
    public function thanks() {
        return view('auth.thanks');
    }

    public function limited()
    {
        return view('auth.limited-access');
    }
}
