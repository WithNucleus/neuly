<?php

namespace App\Http\Middleware;

use Closure;

class IFrameGuard
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
        $response = $next($request);

        if(config('http.enable_x_frame_options'))
        {
            if(in_array(\Route::current()->action['prefix'], config('http.enable_x_frame_options_prefix'))) {
                $response->headers->set('X-Frame-Options', 'ALLOW FROM '.$request->fullUrl(), false);
            } else {
                $response->headers->set('X-Frame-Options', 'DENY', false);
            }
        }

        return $response;
    }
}
