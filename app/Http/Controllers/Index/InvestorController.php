<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use App\Services\StringLengthSort;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class InvestorController extends Controller
{
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('discover.investors.index');
    }

    public function show(Request $request, $slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $investor = Investor::where('slug', $slug)->firstOrFail();

        $metas = Metas::process([
            'title' => $investor->name,
            'description' => '',
            'image' => '',
        ]);

        $entity = 'investors';
        $isFollowed = (bool) count(FollowRepository::fromuser(Investor::class, $investor->id));

        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'investors',
                'slug' => $investor->slug,
                'image' => $investor->logo,
            ])
            ->performedOn($investor)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($investor->name);

        return view('discover.investors.show', compact('investor', 'metas', 'entity', 'isFollowed'));
    }

    public function namesJson()
    {
        return response()->json(Investor::all()->pluck('name'));
    }

    /**
     * Show Jobs for Investor
     *
     * @return View
     */
    public function jobs($slug)
    {
        $owner = Investor::where('slug', $slug)->firstOrFail();
        $jobs = Job::where('owner_id', $owner->id)->where('status', Job::STATUS_OPEN)->orderBy('posted_date', 'desc')->get();

        return view('discover.jobs.listing-by-owner', compact('owner', 'jobs'));
    }
}
