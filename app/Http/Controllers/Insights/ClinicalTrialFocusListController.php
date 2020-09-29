<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Location;
use App\Services\Metas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClinicalTrialFocusListController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->has('orderBy') ? $request->input('orderBy') : 'desc';

        $query = $this->getQuery();

        $query = $query->groupBy('clinicaltrial_focus.focus_id')
            ->orderBy('trials', $orderBy);

        $query = $this->limitRequest($query, 10);

        $focusList = $query->get();

        return response($focusList, Response::HTTP_OK);
    }

    public function show(Request $request)
    {
        $sort = $request->has('sort') ? $request->input('sort') : 'desc';

        $query = $this->getQuery();

        $filters_companies = [];
        $filters_locations = [];

        if ($request->has('filter'))
        {
            $filter = $request->input('filter');
            $query = $this->filterQuery($query, $filter);

            if(isset($filter['company'])) {
                $filters_companies = $this->getCompaniesNameArray($filter['company']);
            }

            if(isset($filter['locations'])) {
                $filters_locations = $this->getLocationsNameArray($filter['locations']);
            }
        }

        $query = $query->groupBy('clinicaltrial_focus.focus_id')
            ->orderBy('trials', $sort);

        $focus = $query
            ->paginate(15)
            ->appends($request->only(['sort', 'filter']));

        $metas = Metas::fromPage($request->path());

        $path = route('insights.most-interest.show');

        // Get All Focus Values
        $company_cats = Company::has('clinicaltrials', '>' , 0)->with('clinicaltrials')->get()->pluck('name')->unique()->sort();

        $location_cats = Location::has('clinicaltrials', '>', 0)->with('clinicaltrials')->get()->pluck('name')->unique()->sort();

        return view('discover.insights.most-interest.show', compact('focus', 'sort', 'metas', 'path', 'company_cats', 'filters_companies', 'location_cats', 'filters_locations'));
    }


    private function getQuery()
    {
        return DB::table('focus')
            ->join('clinicaltrial_focus', 'focus.id', 'clinicaltrial_focus.focus_id')
            ->select('focus.id as id', 'name', 'slug', DB::raw('count(clinicaltrial_focus.focus_id) as trials'));
    }

    private function filterQuery($query, $filter)
    {
        if(isset($filter['companies']))
        {
            $query = $this->filterByCompanies($query, $filter['companies']);
        }

        if(isset($filter['locations']))
        {
            $query = $this->filterByLocations($query, $filter['locations']);
        }

        return $query;
    }

    private function filterByLocations($query, $locations)
    {
        $trialIds = DB::table('clinicaltrial_location')
            ->select('clinicaltrial_id')
            ->whereIn('location_id', $this->getLocationIds($this->getLocationsNameArray($locations)))
            ->groupBy('clinicaltrial_id')
            ->get()->pluck('clinicaltrial_id');

        return $query->whereIn('clinicaltrial_focus.clinicaltrial_id', $trialIds);
    }

    private function filterByCompanies($query, $companies)
    {
        $trialIds = DB::table('clinicaltrial_companies')
            ->select('clinicaltrial_id')
            ->whereIn('company_id', $this->getCompanyIds($this->getCompaniesNameArray($companies)))
            ->groupBy('clinicaltrial_id')
            ->get()->pluck('clinicaltrial_id');

        return $query->whereIn('clinicaltrial_focus.clinicaltrial_id', $trialIds);
    }

    private function limitRequest($query, $limit)
    {
        return $query->take($limit);
    }

    private function getLocationsNameArray($locations) {
        return explode('|', $locations);
    }

    private function getLocationIds($locations)
    {
        return Location::whereIn('name', $locations)->get()->pluck('id');
    }

    private function getCompaniesNameArray($companies)
    {
        return explode('|', $companies);
    }

    private function getCompanyIds($companies)
    {
        return Company::whereIn('name', $companies)->get()->pluck('id');
    }
}
