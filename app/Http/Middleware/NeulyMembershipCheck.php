<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class NeulyMembershipCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Check if User is logged in
        $user = Auth::user();

        if ($user) {

        } else {

            return redirect('/login')->with('message', 'You must be logged in to view this content.');
        }

        // Get User Role

        // et Path
        // $path = $request->getPathInfo();

        // Return Next Request
        return $next($request);
    }
}
