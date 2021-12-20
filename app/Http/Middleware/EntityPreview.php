<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if ($request->has('preview')) {
            view()->share('preview', $request->input('preview'));
            return $next($request);
        }

        if (Auth::check()) {
            return $next($request);
        }

        return redirect()->route('limitedAccess');

    }


}
