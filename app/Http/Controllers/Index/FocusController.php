<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FocusController extends Controller
{

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $focusDrugs = Focus::drugs()->orderBy('name')->get();
        $focusOther = Focus::other()->orderBy('name')->get();

        return view('discover.focus.index', [
            'focusDrugs' => $focusDrugs,
            'focusOther' => $focusOther
        ]);
    }

    // Show
    public function show(Request $request, $slug)
    {
        // Get Focus
        $focus = Focus::where('slug', $slug)
            ->with([
                'bookableListings',
                'clinicaltrials',
                'companies',
                'courses',
                'events',
                'jobs',
                'news',
                'books',
                'podcasts',
                'videos',
                'people',
                'research'
            ])
            ->withCount([
                'bookableListings',
                'clinicaltrials',
                'companies',
                'courses',
                'events',
                'jobs',
                'news',
                'books',
                'podcasts',
                'videos',
                'people',
                'research'
            ])
            ->firstOrFail();

        $metas = Metas::process([
            'title' => $focus->name,
            'description' => '',
            'image' => '',
        ]);

        $entity = 'focus';
        $isFollowed = (bool) count(FollowRepository::fromuser(Focus::class, $focus->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'focus',
                'slug' => $focus->slug,
            ])
            ->performedOn($focus)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($focus->name);

        return view('discover.focus.show', [
            'focus' => $focus,
            'metas' => $metas,
            'entity' => $entity,
            'isFollowed' => $isFollowed
        ]);
    }
}
