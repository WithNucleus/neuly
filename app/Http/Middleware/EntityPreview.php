<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EntityPreview
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->input('preview')) {
            view()->share('preview', $request->input('preview'));
            return $next($request);
        }

        return redirect()->route('limitedAccess');

    }


}
