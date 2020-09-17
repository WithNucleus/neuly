<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Location;
use App\Services\Metas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClinicalTrialCollaboratorsListController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->has('orderBy') ? $request->input('orderBy') : 'desc';

        $query = $this->getQuery();

        $query = $query->groupBy('clinicaltrial_company.company_id')
            ->orderBy('trials', $orderBy);

        $query = $this->limitRequest($query, 10);

        $collaboratorList = $query->get();

        return response($collaboratorList, Response::HTTP_OK);
    }

    public function show(Request $request)
    {
        $sort = $request->has('sort') ? $request->input('sort') : 'desc';

        $query = $this->getQuery();
        $filters_focus = [];

        if ($request->has('filter'))
        {
            $filter = $request->input('filter');
            $query = $this->filterQuery($query, $filter);

            if(isset($filter['focus'])) {
                $filters_focus = $this->getFocusNameArray($filter['focus']);
            }

            if(isset($filter['locations'])) {
                $filters_locations = $this->getLocationsNameArray($filter['locations']);
            }
        }

        $query = $query->groupBy('clinicaltrial_company.company_id')
            ->orderBy('trials', $sort);

        $collaborators = $query->paginate(15);

        $metas = Metas::fromPage($request->path());

        $path = route('insights.collaborators.show');

        // Get All Focus Values
        $focus_cats = Focus::has('clinicaltrials', '>' , 0)->with('clinicaltrials')->get()->pluck('name')->unique()->sort();

        return view('discover.insights.collaborators.show', compact('collaborators', 'sort', 'metas', 'path', 'focus_cats', 'filters_focus'));
    }

    private function getQuery()
    {
        return DB::table('companies')
            ->join('clinicaltrial_company', 'companies.id', 'clinicaltrial_company.company_id')
            ->select('companies.id as id', 'ownership as type', 'name', 'slug', DB::raw('count(clinicaltrial_company.company_id) as trials'));
    }

    private function filterQuery($query, $filter)
    {
        if(isset($filter['focus']))
        {
            $query = $this->filterByFocus($query, $filter['focus']);
        }

        if(isset($filter['locations']))
        {
            $query = $this->filterByLocations($query, $filter['locations']);
        }

        return $query;
    }

    private function filterByFocus($query, $focus)
    {

        $trialIds = DB::table('clinicaltrial_focus')
            ->select('clinicaltrial_id')
            ->whereIn('focus_id', $this->getFocusIds($this->getFocusNameArray($focus)))
            ->groupBy('clinicaltrial_id')
            ->get()->pluck('clinicaltrial_id');

        return $query->whereIn('clinicaltrial_company.clinicaltrial_id', $trialIds);
    }

    private function filterByLocations($query, $locations)
    {
        $trialIds = DB::table('clinicaltrial_location')
            ->select('clinicaltrial_id')
            ->whereIn('location_id', $this->getLocationIds($this->getLocationsNameArray($locations)))
            ->groupBy('clinicaltrial_id')
            ->get()->pluck('clinicaltrial_id');

        return $query->whereIn('clinicaltrial_company.clinicaltrial_id', $trialIds);
    }

    private function limitRequest($query, $limit)
    {
        return $query->take($limit);
    }

    private function getFocusNameArray($focus) {
        return explode('|', $focus);
    }

    private function getFocusIds($focus) {
        return Focus::whereIn('name', $focus)->get()->pluck('id');
    }

    private function getLocationsNameArray($locations) {
        return explode('|', $locations);
    }

    private function getLocationIds($locations)
    {
        return Location::whereIn('name', $locations)->get()->pluck('id');
    }
}
