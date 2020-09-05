<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Focus;
use App\Services\Metas;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Activitylog\Models\Activity;
use Auth;

class FocusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('query_filters')->only('index', 'past');
    }

    // Index
    public function index(Request $request) {

        // Get Focus
        // $focus_items = Focus::with('companies')->orderBy('name')->get();
        $focus_items = QueryBuilder::for(Focus::class)
            ->allowedFilters([
                AllowedFilter::partial('company', 'companies.name'),
                AllowedFilter::partial('focus', 'name'),
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name'
            ])
            ->paginate(10)
            ->appends(request()->query());

        //$focus_cats = Focus::pluck('name')->unique()->sort();
        // $focus_cats = $focus_items->pluck('name')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        return view('discover.focus.index', compact('focus_items', 'metas'));
    }

    // Show
    public function show(Request $request, $slug) {

        // Get Focus
        $focus = Focus::where('slug', $slug)->firstOrFail();

        $metas = Metas::process(array(
            'title'         => $focus->name,
            'description'   => '',
            'image'         => '',
        ));

        $entity = 'focus';
        $isFollowed = (bool) count(FollowRepository::fromuser(Focus::class, $focus->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'focus',
                'slug' => $focus->slug
            ])
            ->performedOn($focus)
            ->log($focus->name);

        return view('discover.focus.show', compact('focus', 'metas', 'entity', 'isFollowed'));
    }
}
