<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Clinicaltrial;
use App\Models\Focus;
use App\Repositories\BookmarkRepository;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\Activitylog\Models\Activity;
use Auth;
use DB;
use App\Models\Location;

class ClinicaltrialController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    // Index
    public function index(Request $request)
    {

        $clinicaltrials = QueryBuilder::for(Clinicaltrial::class)
            ->allowedFilters([
                'nct_number',
                'title',
                'study_results',
                AllowedFilter::exact('status'),
                AllowedFilter::exact('focus', 'focus.name'),
                AllowedFilter::partial('locations', 'locations.name'),
                AllowedFilter::partial('companies', 'companies.name'),
                AllowedFilter::partial('people', 'people.name'),
            ])
            ->defaultSort('-start_date')
            ->allowedSorts([
                AllowedSort::field('start', 'start_date'),
                AllowedSort::field('updated', 'last_update_posted'),
                'title'
            ])
            ->paginate(10)
            ->appends(request()->query());

    	$status = Clinicaltrial::pluck('status')->unique()->sort();

        $location_ids = DB::table('clinicaltrial_location')->pluck('location_id')->unique();
        $locations = Location::findMany($location_ids)->sortBy('country')->pluck('country')->unique();

        $focus_cats = array(
            'Psilocybin',
            'MDMA',
            'LSD',
            'DMT',
            'Ketamine',
            'Ibogaine',
            'GHB',
            'Tryptamine',
        );

        return view('discover.clinicaltrials.index', compact('clinicaltrials', 'status', 'focus_cats', 'locations'));
    }

    public function show(Request $request, $slug)
    {
        $clinicaltrial = Clinicaltrial::where('slug', $slug)->firstOrFail();

        $entity = 'clinicaltrials';
        $bookmarks = BookmarkRepository::fromUser($entity, $clinicaltrial->id);
        $isFollowed = (bool) count(FollowRepository::fromuser(Clinicaltrial::class, $clinicaltrial->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'clinicaltrials',
                'slug' => $clinicaltrial->slug
            ])
            ->performedOn($clinicaltrial)
            ->log($clinicaltrial->title);

        return view('discover.clinicaltrials.show', compact('clinicaltrial', 'entity', 'bookmarks', 'isFollowed'));
    }
}
