<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Illuminate\Http\Request;
use App\Models\Focus;
use App\Models\Clinicaltrial;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
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
                AllowedFilter::exact('company', 'companies.name'),
                AllowedFilter::exact('researchers', 'people.name'),
                AllowedFilter::partial('conditions', 'conditions.value'),
                AllowedFilter::partial('interventions', 'interventions.value'),
                AllowedFilter::partial('outcome_measures', 'outcomeMeasures.value'),
                AllowedFilter::partial('study_designs', 'studyDesigns.value'),
                AllowedFilter::scope('year', 'startYear', '|'),
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
        $years = Clinicaltrial::select(DB::raw('YEAR(start_date) as year'))->distinct()->orderBy('year', 'desc')->get()->pluck('year');
        $focus_cats = Focus::drugs()->orderBy('name')->get()->pluck('name');
        $locations = Location::select('country')
            ->join('clinicaltrial_location', 'locations.id', 'clinicaltrial_location.location_id')
            ->orderBy('country')
            ->pluck('country')
            ->unique();

        $filters_companies = [];
        $filters_researchers = [];
        $filters_conditions = [];
        $filters_interventions = [];
        $filters_outcome_measures = [];
        $filters_study_designs = [];
        $filters_year = [];

        if ($request->has('filter')) {
            $filterInput = $request->input('filter');
            $filter = array_map(function ($entity) {
                return explode('|', $entity);
            }, $filterInput);

            if(isset($filter['company'])) {
                $filters_companies = $filter['company'];
            }

            if(isset($filter['researchers'])) {
                $filters_researchers = $filter['researchers'];
            }

            if(isset($filter['conditions'])) {
                $filters_conditions = $filter['conditions'];
            }

            if(isset($filter['interventions'])) {
                $filters_interventions = $filter['interventions'];
            }

            if(isset($filter['outcome_measures'])) {
                $filters_outcome_measures = $filter['outcome_measures'];
            }

            if(isset($filter['study_designs'])) {
                $filters_study_designs = $filter['study_designs'];
            }

            if(isset($filter['year'])) {
                $filters_year = $filter['year'];
            }
        }

        $metas = Metas::fromPage($request->path());

        return view('discover.clinicaltrials.index', compact(
            'clinicaltrials',
            'status',
            'years',
            'focus_cats',
            'locations',
            'filters_companies',
            'filters_researchers',
            'filters_conditions',
            'filters_interventions',
            'filters_outcome_measures',
            'filters_study_designs',
            'filters_year',
            'metas',
        ));
    }

    public function show(Request $request, $slug)
    {
        $clinicaltrial = Clinicaltrial::with([
                'conditions',
                'interventions',
                'outcomeMeasures',
                'studyDesigns',
                'locations',
                'people',
                'companies'
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        $entity = 'clinicaltrials';
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
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($clinicaltrial->title);

        return view('discover.clinicaltrials.show', compact('clinicaltrial', 'entity', 'isFollowed'));
    }
}
