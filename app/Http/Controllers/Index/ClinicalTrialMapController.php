<?php

namespace App\Http\Controllers\Index;

use App\Helpers\MapHelper;
use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Models\Focus;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClinicalTrialMapController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showMap(Request $request)
    {
        $focus = Focus::hasClinicalTrials()->orderBy('name');
        $focus_cats = $focus->pluck('name')->toArray();

        $focus = $this->filterFocus($this->filterFocusValues($request), $focus);
        $focus = $focus->get();

        $status = Clinicaltrial::select('status')->groupBy('status')->pluck('status')->toArray();
        $filters_status = $this->filterStatusValues($request);

        $trials = $this->getClinicalTrialsByStatus($filters_status);

        if ($filters_status === null) {
            $filters_status = [];
        }

        $sort = $this->getOrderDirection($this->getSortParameter($request));
        $countriesByCode = $this->getCountriesResultByCode($sort, $focus, $trials);

        $filters_focus = $focus->pluck('name')->toArray();
        $path = route('discover.clinicaltrials.map');

        return view('discover.clinicaltrials.maps.global', compact('countriesByCode', 'filters_focus', 'focus_cats', 'path', 'sort', 'status', 'filters_status'));
    }

    public function showCountry(Request $request, $country)
    {
        $focus = Focus::hasClinicalTrials()->orderBy('name');
        $focus_cats = $focus->pluck('name')->toArray();

        $focus = $this->filterFocus($this->filterFocusValues($request), $focus);
        $focus = $focus->get();

        $status = Clinicaltrial::select('status')->groupBy('status')->pluck('status')->toArray();
        $filters_status = $this->filterStatusValues($request);

        $trials = $this->getClinicalTrialsByStatus($filters_status);

        if ($filters_status === null) {
            $filters_status = [];
        }

        $sort = $this->getOrderDirection($this->getSortParameter($request));

        $regionsByCode = $this->getCountryResult($country, $sort, $focus, $trials);

        $filters_focus = $focus->pluck('name')->toArray();
        $path = route('discover.clinicaltrials.map.country', $country);
        $map = MapHelper::getCountryMap($country);

        if (! $map['show']) {
            return abort(404);
        }

        return view('discover.clinicaltrials.maps.country', compact('regionsByCode', 'filters_focus', 'focus_cats', 'path', 'sort', 'map', 'country'));
    }

    /**
     * @param $values
     * @param $query
     * @return mixed
     */
    private function filterFocus($values, $query)
    {
        if ($values !== []) {
            $query = $query->whereIn('name', $values);
        }

        return $query;
    }

    /**
     * @param $request
     * @return array|false|string[]
     */
    private function filterFocusValues($request)
    {
        $filters_focus = [];
        if ($this->filterHasFocus($request)) {
            $filters_focus = $this->getFilteredValues($request->input('filter')['focus']);
        }

        return $filters_focus;
    }

    /**
     * @param $request
     * @return array|false|string[]
     */
    private function filterStatusValues($request)
    {
        $filter_status = null;
        if ($this->filterHasStatus($request)) {
            $filter_status = $this->getFilteredValues($request->input('filter')['status']);
        }

        return $filter_status;
    }

    /**
     * @param $request
     * @return bool
     */
    private function filterHasFocus($request)
    {
        return $request->has('filter') && array_key_exists('focus', $request->input('filter'));
    }

    private function filterHasStatus($request)
    {
        return $request->has('filter') && array_key_exists('status', $request->input('filter'));
    }

    /**
     * @param $filter
     * @return false|string[]
     */
    private function getFilteredValues($filter)
    {
        return explode('|', $filter);
    }

    /**
     * @param $sortParameter
     * @return string
     */
    private function getOrderDirection($sortParameter)
    {
        $sort = 'ASC';

        if (Str::contains($sortParameter, '-')) {
            $sort = 'DESC';
        }

        return $sort;
    }

    /**
     * @param $request
     * @return string
     */
    private function getSortParameter($request)
    {
        $sort = '';
        if ($request->has('sort')) {
            $sort = $request->input('sort');
        }

        return $sort;
    }

    private function getClinicalTrialsByCountry($locationsByCountries, $trials)
    {
        $trialsByCountry = [];

        foreach ($locationsByCountries as $alpha2code => $country) {
            $trialsByCountry[$alpha2code]['name'] = $country['name'];
            $trialsByCountry[$alpha2code]['clinicaltrials'] = $this->getClinicalTrialsByLocations($country['locations'], $trials);
        }

        return $trialsByCountry;
    }

    private function getClinicalTrialsByLocations($locations, $trials)
    {
        return DB::table('clinicaltrial_location')
                ->whereIn('location_id', $locations)
                ->whereIn('clinicaltrial_id', $trials)
                ->pluck('clinicaltrial_id')
                ->toArray();
    }

    private function getClinicalTrialsByStatus($status)
    {
        $trials = [];

        if ($status !== null) {
            $trials = Clinicaltrial::whereIn('status', $status)
                ->pluck('id')
                ->toArray();
        } else {
            $trials = Clinicaltrial::all()->pluck('id')->toArray();
        }

        return $trials;
    }

    public function getClinicalTrialsByRegions($locationsByRegions, $trials)
    {
        $trialsByRegion = [];
        foreach ($locationsByRegions as $region_code => $region) {
            $trialsByRegion[$region_code]['name'] = $region['name'];
            $trialsByRegion[$region_code]['jobs'] = $this->getClinicalTrialsByLocations($region['locations'], $trials);
        }

        return $trialsByRegion;
    }

    private function countClinicalTrialsByFocus($clinicaltrials, $focus)
    {
        return DB::table('clinicaltrial_focus')
                ->whereIn('clinicaltrial_id', $clinicaltrials)
                ->where('focus_id', '=', $focus)
                ->selectRaw('COUNT(clinicaltrial_id) as clinicaltrials')
                ->get('clinicaltrials')
                ->toArray()[0]
                ->clinicaltrials;
    }

    private function getClinicalTrialsMappingByCountriesAndFocus($trialsByCountries, $focus)
    {
        $trialsByCountriesAndFocus = [];
        foreach ($trialsByCountries as $alpha2code => $country) {
            $trialsByCountriesAndFocus[$alpha2code]['name'] = $country['name'];
            $trialsByCountriesAndFocus[$alpha2code]['total'] = count($country['clinicaltrials']);

            foreach ($focus as $item) {
                $trialsByCountriesAndFocus[$alpha2code]['focus'][$item->name] = $this->countClinicalTrialsByFocus($country['clinicaltrials'], $item->id);
            }
        }

        return $trialsByCountriesAndFocus;
    }

    private function getClinicalTrialsMappingByRegionsAndFocus($jobsByRegions, $focus)
    {
        $trialsByByRegionsAndFocus = [];
        foreach ($jobsByRegions as $region_code => $region) {
            $trialsByByRegionsAndFocus[$region_code]['name'] = $region['name'];
            $trialsByByRegionsAndFocus[$region_code]['total'] = count($region['jobs']);

            foreach ($focus as $item) {
                $trialsByByRegionsAndFocus[$region_code]['focus'][$item->name] = $this->countClinicalTrialsByFocus($region['jobs'], $item->id);
            }
        }

        return $trialsByByRegionsAndFocus;
    }

    private function getCountriesResultByCode($sort, $focus, $trials)
    {
        $locationsByCountries = Location::byCountries($sort);
        $trialsByCountries = $this->getClinicalTrialsByCountry($locationsByCountries, $trials);

        return $this->getClinicalTrialsMappingByCountriesAndFocus($trialsByCountries, $focus);
    }

    private function getCountryResult($country, $sort, $focus, $trials)
    {
        $locations = Location::byRegions($country, $sort);
        $jobsByRegions = $this->getClinicalTrialsByRegions($locations, $trials);

        return $this->getClinicalTrialsMappingByRegionsAndFocus($jobsByRegions, $focus);
    }
}
