<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Overwrite showLoginForm to save the previous URL into the session.
     * 
     * @return View
     */
    public function showLoginForm()
    {
        session()->put('loginRedirect', url()->previous());
        return view('auth.login');
    }

    /** 
     * Overwrite $redirectTo property to redirect to previous page.
     * 
     * @return string URL to redirect to
     */
    public function redirectTo()
    {
        return session('loginRedirect');
    }
}
