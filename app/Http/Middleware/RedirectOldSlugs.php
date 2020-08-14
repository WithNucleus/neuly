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
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($this->needsRedirect($request, $response)) {
            $slug      = $request->route()->slug;
            $redirect  = Redirect::where('old_slug', $slug)->firstOrFail();
            $newSlug   = $redirect->redirectable->slug;
            $routeName = $request->route()->getName();
            if ($routeName) {
                $params         = $request->route()->parameters();
                $params['slug'] = $newSlug;

                return redirect()->route($routeName, $params, 301);
            }
            $routePath = $request->getPathInfo();
            $newRoute  = str_replace($slug, $newSlug, $routePath);

            return redirect($newRoute, 301);
        }

        return $response;
    }

    /**
     * Check if request need redirect
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  \Illuminate\Http\Response  $response
     *
     * @return bool
     */
    private function needsRedirect($request, $response)
    {
        return $response->getStatusCode() === 404 && $request->route()->hasParameter('slug');
    }
}
