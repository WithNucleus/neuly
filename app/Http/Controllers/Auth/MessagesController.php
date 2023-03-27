<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function registerSuccess()
    {
        return view('auth.thanks');
    }
}
