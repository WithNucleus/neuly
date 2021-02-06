<?php

namespace App\Http\Controllers\Index;

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
        $filters_focus = [];

        if ($request->has('filter') && array_key_exists('focus', $request->input('filter'))) {
            $filters_focus = $this->getFilteredFocus($request->input('filter')['focus']);
        }

        $focus = Focus::drugs()->orderBy('name');

        if ($filters_focus !== []) {
            $focus->whereIn('name', $filters_focus);
        }

        $focus = $focus->get();

        $sort = '';

        if ($request->has('sort')) {
            $sort = $request->input('sort');
        }

        $locationsByCountries = Location::byCountries($this->getOrderDirection(''));
        $jobsByCountries = $this->getJobsByCountries($locationsByCountries);
        $countriesByCode = $this->getJobsMappingByCountryAndFocus($jobsByCountries, $focus);

        $focus = $focus->pluck('name');
        $path = route('discover.jobs.map');

        return view('discover.locations.maps.global-jobs', compact('countriesByCode', 'focus', 'filters_focus', 'path', 'sort'));
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
            $jobsByCountry[$alpha2code]['jobs'] = $this->getJobsByCountry($country['locations']);
        }

        return $jobsByCountry;
    }

    /**
     * @param $locations
     * @return array
     */
    private function getJobsByCountry($locations)
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
    private function getJobsMappingByCountryAndFocus($jobsByCountries, $focus)
    {
        $jobsByCountriesAndFocus = [];
        foreach ($jobsByCountries as $alpha2code => $country) {
            $jobsByCountriesAndFocus[$alpha2code]['name'] = $country['name'];
            $jobsByCountriesAndFocus[$alpha2code]['total'] = count($country['jobs']);

            foreach ($focus as $item) {
                $jobsByCountriesAndFocus[$alpha2code]['focus'][$item->name] = $this->countJobsByFocusAndCountry($country['jobs'], $item->id);
            }
        }

        return $jobsByCountriesAndFocus;
    }

    /**
     * @param $jobs
     * @param $focus
     * @return \Illuminate\Support\Collection
     */
    private function countJobsByFocusAndCountry($jobs, $focus)
    {
        return DB::table('focus_job')
                ->whereIn('job_id', $jobs)
                ->where('focus_id', '=', $focus)
                ->selectRaw('COUNT(job_id) as jobs')->get('jobs')->toArray()[0]->jobs;
    }

    /**
     * @param $filter
     * @return false|string[]
     */
    private function getFilteredFocus($filter)
    {
        return explode('|', $filter);
    }

    private function getOrderDirection($sortParameter)
    {
        $sort = 'ASC';

        if (Str::contains($sortParameter, '-')) {
            $sort = 'DESC';
        }

        return $sort;
    }
}
