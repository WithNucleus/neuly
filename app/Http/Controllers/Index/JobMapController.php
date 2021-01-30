<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobMapController extends Controller
{
    /**
     * Show.
     * @return \Illuminate\View\View
     */
    public function showMap(Request $request)
    {
        $locationsByCountries = Location::byCountries();
        $jobsByCountries = $this->getJobsByCountries($locationsByCountries);
        $countriesByCode = $this->getJobsMappingByCountryAndFocus($jobsByCountries, Focus::all());

        return view('discover.locations.maps.global-jobs', compact('countriesByCode'));
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
}
