<?php

namespace App\Http\Middleware;

use Closure;

class FeaturePolicyGuard
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
        if(config('http.enable_feature_policy'))
        {
            $response->headers->set('FeaturePolicy', config('http.feature_policy_value'));

        }
        return $response;
    }
}
