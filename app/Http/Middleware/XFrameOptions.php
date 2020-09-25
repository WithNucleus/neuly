<?php

namespace App\Http\Middleware;

use Closure;

class XFrameOptions
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
        
        if(\Route::current()->action['prefix'] === 'embeds' ||
            \Route::current()->action['prefix'] === 'api/embeds') {
            $response->headers->set('X-Frame-Options', 'ALLOW FROM '.$request->fullUrl(), false);
        } else {
            $response->headers->set('X-Frame-Options', 'DENY', false);
        }


        return $response;
    }
}
