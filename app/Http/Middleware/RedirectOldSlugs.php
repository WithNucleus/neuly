<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;

class RedirectOldSlugs
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
        if ($request->route()->getPrefix() !== config('backpack.base.route_prefix', 'admin')) {
            $responseStatus = $next($request)->getStatusCode();
            if ($responseStatus === 404 && $request->route()->hasParameter('slug')) {
                $slug           = $request->route()->slug;
                $redirect       = Redirect::where('old_slug', $slug)->firstOrFail();
                $routeName      = $request->route()->getName();
                $params         = $request->route()->parameters();
                $params['slug'] = $redirect->redirectable->slug;

                return redirect()->route($routeName, $params, 301);
            }
        }
        return $next($request);
    }
}
