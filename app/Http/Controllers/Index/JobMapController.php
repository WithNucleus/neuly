<?php

namespace App\Http\Controllers\Index;

use App\Helpers\MapHelper;
use App\Http\Controllers\Controller;
use App\Models\Focus;
use App\Models\Job;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobMapController extends Controller
{
    /**
     * Show.
     *
     * @return \Illuminate\View\View
     */
    public function showMap(Request $request)
    {
        $focus = Focus::hasJobs()->orderBy('name');
        $focus_cats = $focus->pluck('name')->toArray();

        $focus = $this->filterFocus($this->filterFocusValues($request), $focus);
        $focus = $focus->get();

        $sort = $this->getOrderDirection($this->getSortParameter($request));

        $filters_type = null;

        if ($this->filterHasType($request)) {
            $filters_type = $request->input('filter')['type'];
        }

        $jobs = $this->getJobsByEmploymentType($filters_type);

        $countriesByCode = $this->getCountriesResultByCode($sort, $focus, $jobs);

        $filters_focus = $focus->pluck('name')->toArray();

        $filters_type = $this->filteredTypeToArray($filters_type);

        $path = route('discover.jobs.map');

        return view('discover.jobs.maps.global', compact('countriesByCode', 'filters_focus', 'focus_cats', 'path', 'sort', 'filters_type'));
    }

    public function showCountry(Request $request, $country)
    {
        $focus = Focus::hasJobs()->orderBy('name');
        $focus_cats = $focus->pluck('name')->toArray();

        $focus = $this->filterFocus($this->filterFocusValues($request), $focus);
        $focus = $focus->get();

        $sort = $this->getOrderDirection($this->getSortParameter($request));

        $filters_type = null;

        if ($this->filterHasType($request)) {
            $filters_type = $request->input('filter')['type'];
        }

        $jobs = $this->getJobsByEmploymentType($filters_type);

        $regionsByCode = $this->getCountryResult($country, $sort, $focus, $jobs);

        $filters_focus = $focus->pluck('name')->toArray();
        $path = route('discover.jobs.map.country', $country);
        $map = MapHelper::getCountryMap($country);

        $filters_type = $this->filteredTypeToArray($filters_type);

        if (! $map['show']) {
            return abort(404);
        }

        return view('discover.jobs.maps.country', compact('regionsByCode', 'filters_focus', 'focus_cats', 'path', 'sort', 'map', 'country', 'filters_type'));
    }

    /**
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
     * @return array|false|string[]
     */
    private function filterFocusValues($request)
    {
        $filters_focus = [];
        if ($this->filterHasFocus($request)) {
            $filters_focus = $this->getFilteredFocus($request->input('filter')['focus']);
        }

        return $filters_focus;
    }

    /**
     * @return bool
     */
    private function filterHasFocus($request)
    {
        return $request->has('filter') && array_key_exists('focus', $request->input('filter'));
    }

    private function filterHasType($request)
    {
        return $request->has('filter') && array_key_exists('type', $request->input('filter'));
    }

    /**
     * @return false|string[]
     */
    private function getFilteredFocus($filter)
    {
        return explode('|', $filter);
    }

    private function filteredTypeToArray($filter)
    {
        return $filter !== null ? [$filter] : [];
    }

    /**
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

    /**
     * @return array
     */
    private function getJobsByCountries($locationsByCountries, $jobs)
    {
        $jobsByCountry = [];
        foreach ($locationsByCountries as $alpha2code => $country) {
            $jobsByCountry[$alpha2code]['name'] = $country['name'];
            $jobsByCountry[$alpha2code]['jobs'] = $this->getJobsByLocations($country['locations'], $jobs);
        }

        return $jobsByCountry;
    }

    /**
     * @return mixed
     */
    public function getJobsByRegions($locationsByRegions, $jobs)
    {
        $jobsByRegion = [];
        foreach ($locationsByRegions as $region_code => $region) {
            $jobsByRegion[$region_code]['name'] = $region['name'];
            $jobsByRegion[$region_code]['jobs'] = $this->getJobsByLocations($region['locations'], $jobs);
        }

        return $jobsByRegion;
    }

    /**
     * @param  null  $type
     * @return mixed
     */
    private function getJobsByEmploymentType($type = null)
    {
        $jobs = [];

        if ($type !== null) {
            $jobs = Job::where('employment_type', '=', $type)->pluck('id')->toArray();
        } else {
            $jobs = Job::all()->pluck('id')->toArray();
        }

        return $jobs;
    }

    /**
     * @return array
     */
    private function getJobsByLocations($locations, $jobs)
    {
        return DB::table('job_location')
            ->whereIn('location_id', $locations)
            ->whereIn('job_id', $jobs)
            ->pluck('job_id')
            ->toArray();
    }

    /**
     * @return array
     */
    private function getJobsMappingByCountriesAndFocus($jobsByCountries, $focus)
    {
        $jobsByCountriesAndFocus = [];
        foreach ($jobsByCountries as $alpha2code => $country) {
            $jobsByCountriesAndFocus[$alpha2code]['name'] = $country['name'];
            $jobsByCountriesAndFocus[$alpha2code]['total'] = count($country['jobs']);

            foreach ($focus as $item) {
                $jobsByCountriesAndFocus[$alpha2code]['focus'][$item->name] = $this->countJobsByFocus($country['jobs'], $item->id);
            }
        }

        return $jobsByCountriesAndFocus;
    }

    private function getJobsMappingByRegionsAndFocus($jobsByRegions, $focus)
    {
        $jobsByRegionsAndFocus = [];
        foreach ($jobsByRegions as $region_code => $region) {
            $jobsByRegionsAndFocus[$region_code]['name'] = $region['name'];
            $jobsByRegionsAndFocus[$region_code]['total'] = count($region['jobs']);

            foreach ($focus as $item) {
                $jobsByRegionsAndFocus[$region_code]['focus'][$item->name] = $this->countJobsByFocus($region['jobs'], $item->id);
            }
        }

        return $jobsByRegionsAndFocus;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function countJobsByFocus($jobs, $focus)
    {
        return DB::table('focus_job')
            ->whereIn('job_id', $jobs)
            ->where('focus_id', '=', $focus)
            ->selectRaw('COUNT(job_id) as jobs')->get('jobs')->toArray()[0]->jobs;
    }

    /**
     * @return array
     */
    private function getCountriesResultByCode($sort, $focus, $jobs)
    {
        $locationsByCountries = Location::byCountries($sort);
        $jobsByCountries = $this->getJobsByCountries($locationsByCountries, $jobs);

        return $this->getJobsMappingByCountriesAndFocus($jobsByCountries, $focus);
    }

    private function getCountryResult($country, $sort, $focus, $jobs)
    {
        $locations = Location::byRegions($country, $sort);
        $jobsByRegions = $this->getJobsByRegions($locations, $jobs);

        return $this->getJobsMappingByRegionsAndFocus($jobsByRegions, $focus);
    }
}
