<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LocationController extends Controller
{

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.locations.index', compact('metas'));
    }

    // Show
    public function show(Request $request, $slug)
    {
        $location = Location::with([
                'bookableListings',
                'companies',
                'people',
                'investors',
                'jobs',
                'events',
                'clinicaltrials',
            ])
            ->withCount([
                'bookableListings',
                'companies',
                'people',
                'investors',
                'jobs',
                'events',
                'clinicaltrials',
            ])->where('slug', $slug)->firstOrFail();

        $entity = $location;

        $metas = Metas::process([
            'title' => $location->name,
            'description' => '',
            'image' => '',
        ]);

        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'locations',
                'slug' => $location->slug,
            ])
            ->performedOn($location)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($location->name);

        return view('discover.locations.show', compact('location', 'metas', 'entity'));
    }

    public function citynames(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Location::all()->pluck('name'));
    }
}
