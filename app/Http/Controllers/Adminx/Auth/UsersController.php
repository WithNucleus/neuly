<?php

namespace App\Http\Controllers\Adminx\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'auth');
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.auth.users.index');
    }

    public function show($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::findOrFail($id);
        return view('adminx.auth.users.show', [
            'user' => $user
        ]);
    }
}
