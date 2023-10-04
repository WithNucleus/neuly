<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserOnboarding
{
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        if ($request->user()->last_name == '') {
            return Redirect::route('member.onboarding.welcome');
        }

        return $next($request);
    }
}
