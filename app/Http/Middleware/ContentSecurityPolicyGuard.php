<?php

namespace App\Http\Middleware;

use Closure;

class ContentSecurityPolicyGuard
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

        if(config('http.enable_content_security_policy'))
        {
            $response->headers->set('Content-Security-Policy', config('http.content_security_policy_value'));
        }

        return $response;
    }
}
