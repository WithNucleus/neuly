<?php

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPersonController extends Controller
{
    public function index()
    {
        $hasPerson = Auth::user()->relatedPerson;
        return view('members.person.index', compact('hasPerson'));
    }
}
