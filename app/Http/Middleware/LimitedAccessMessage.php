<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\Person;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LimitedAccessMessage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->isMethod('post') AND ($request->getPathInfo() === '/listing/request' OR $request->getPathInfo() === '/listing/request/finish') AND $request->input('preview_request')) {

            $previewRequest = [
                'type' => $request->input('entity_type'),
                'id' => $request->input('to_update_id'),
                'code' => $request->input('preview_request')
            ];

            if ($this->checkEntityPreviewCode($previewRequest) === true) {
                view()->share('previewRequest', $previewRequest);
                return $next($request);
            }
        }

        if ($request->route()->getName() === 'discover.organizations.show' OR $request->route()->getName() === 'discover.people.show') {
            if ($request->input('preview')) {
                view()->share('preview', $request->input('preview'));
                return $next($request);
            }
        }

        if (Auth::check() === true) {
            return $next($request);
        }

        return redirect()->route('limitedAccess');
    }

    /**
     * For entities with Preview option, verifies the preview code matches the request
     */
    private function checkEntityPreviewCode($previewRequest): bool
    {
        $allowedEntities = [
            'organization' => Company::class,
            'person' => Person::class,
        ];

        if (array_key_exists($previewRequest['type'], $allowedEntities)) {
            $model = $allowedEntities[$previewRequest['type']];
            $entity = $model::findOrFail($previewRequest['id']);

            if ($entity->visibility_code === $previewRequest['code']) {
                return true;
            }
        }

        return false;
    }
}
