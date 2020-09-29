<?php

namespace App\Http\Middleware;

use Closure;

class ExpectCTGuard
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
        if(config('http.enable_except_ct'))
        {
            $response->header('Expect-CT', config('http.except_ct_value'));
        }
        return $response;
    }
}
