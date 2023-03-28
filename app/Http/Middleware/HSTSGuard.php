<?php

namespace App\Http\Middleware;

use Closure;

class HSTSGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (config('http.enable_hsts')) {
            $response->headers->set('Strict-Transport-Security', config('http.hsts_value'));
        }

        return $response;
    }
}
