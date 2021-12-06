<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function registerSuccess()
    {
        return view('auth.thanks');
    }

    public function limitedAccess()
    {
        return view('auth.limited-access');
    }
}
