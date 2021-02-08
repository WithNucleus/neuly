<?php

namespace App\Http\Controllers\Index;

use App\Helpers\MapHelper;
use App\Http\Controllers\Controller;
use App\Models\Focus;
use App\Models\Location;
use App\Services\Metas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobMapController extends Controller
{
    /**
     * Show.
     * @return \Illuminate\View\View
     */
    public function showMap(Request $request)
    {
        $focus = Focus::drugs()->orderBy('name');
        $focus_cats = $focus->pluck('name')->toArray();

        $focus = $this->filterFocus($this->filterFocusValues($request), $focus);
        $focus = $focus->get();

        $sort = $this->getOrderDirection($this->getSortParameter($request));
        $countriesByCode = $this->getCountriesResultByCode($sort, $focus);

        $filters_focus = $focus->pluck('name')->toArray();
        $path = route('discover.jobs.map');

        return view('discover.jobs.maps.global', compact('countriesByCode', 'filters_focus', 'focus_cats', 'path', 'sort'));
    }

    public function showCountry(Request $request, $country)
    {
        $focus = Focus::drugs()->orderBy('name');
        $focus_cats = $focus->pluck('name')->toArray();

        $focus = $this->filterFocus($this->filterFocusValues($request), $focus);
        $focus = $focus->get();

        $sort = $this->getOrderDirection($this->getSortParameter($request));

        $regionsByCode = $this->getCountryResult($country, $sort, $focus);

        $filters_focus = $focus->pluck('name')->toArray();
        $path = route('discover.jobs.map.country', $country);
        $map = MapHelper::getCountryMap($country);

        //dd($regionsByCode);

        return view('discover.jobs.maps.country', compact('regionsByCode', 'filters_focus', 'focus_cats', 'path', 'sort', 'map', 'country'));
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
            $filters_focus = $this->getFilteredFocus($request->input('filter')['focus']);
        }

        return $filters_focus;
    }

    /**
     * @param $request
     * @return bool
     */
    private function filterHasFocus($request)
    {
        return $request->has('filter') && array_key_exists('focus', $request->input('filter'));
    }

    /**
     * @param $filter
     * @return false|string[]
     */
    private function getFilteredFocus($filter)
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

    /**
     * @param $locationsByCountries
     * @return array
     */
    private function getJobsByCountries($locationsByCountries)
    {
        $jobsByCountry = [];
        foreach ($locationsByCountries as $alpha2code => $country) {
            $jobsByCountry[$alpha2code]['name'] = $country['name'];
            $jobsByCountry[$alpha2code]['jobs'] = $this->getJobsByLocations($country['locations']);
        }

        return $jobsByCountry;
    }

    /**
     * @param $locationsByRegions
     * @return mixed
     */
    public function getJobsByRegions($locationsByRegions)
    {
        $jobsByRegion = [];
        foreach ($locationsByRegions as $region_code => $region) {
            $jobsByRegion[$region_code]['name'] = $region['name'];
            $jobsByRegion[$region_code]['jobs'] = $this->getJobsByLocations($region['locations']);
        }

        return $jobsByRegion;
    }

    /**
     * @param $locations
     * @return array
     */
    private function getJobsByLocations($locations)
    {
        return DB::table('job_location')
                ->whereIn('location_id', $locations)
                ->pluck('job_id')
                ->toArray();
    }

    /**
     * @param $jobsByCountries
     * @param $focus
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
     * @param $jobs
     * @param $focus
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
     * @param $sort
     * @param $focus
     * @return array
     */
    private function getCountriesResultByCode($sort, $focus)
    {
        $locationsByCountries = Location::byCountries($sort);
        $jobsByCountries = $this->getJobsByCountries($locationsByCountries);

        return $this->getJobsMappingByCountriesAndFocus($jobsByCountries, $focus);
    }

    private function getCountryResult($country, $sort, $focus)
    {
        $locations = Location::byRegions($country, $sort);
        $jobsByRegions = $this->getJobsByRegions($locations);
        return $this->getJobsMappingByRegionsAndFocus($jobsByRegions, $focus);
    }
}
