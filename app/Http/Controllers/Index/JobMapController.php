<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class JobMapController extends Controller
{
    private $focusIds;
    private $focusNames;

    public function __construct()
    {
        $this->focusIds = Focus::pluck('id');
        $this->focusNames = Focus::pluck('name', 'id');
    }

    public function showMap(Request $request)
    {
        $locationsQuery = Location::whereNotNull('alpha2code');

        $locations = $locationsQuery
            ->orderBy('country')
            ->get()
            ->groupBy('alpha2code')
            ->toArray();

        $locationsByCountries = $this->getLocationsOfCountries($locations);
        $jobsByCountries = $this->getJobsOfCountries($locationsByCountries);
        $countriesByCode = $this->buildJobByFocusData($jobsByCountries);


        return view('discover.locations.maps.advanced-global', compact('countriesByCode'));
    }

    private function getLocationsOfCountries($countries)
    {
        $countries_locations = [];

        foreach ($countries as $alpha2code => $locations) {
            $country_locations = [];
            foreach ($locations as $location) {
                $country_locations[] = $location['id'];
            }
            $countries_locations[$alpha2code] = $country_locations;
        }

        return $countries_locations;
    }

    private function getJobsOfCountries($locationsByCountries)
    {
        $jobsByCountries = [];
        foreach ($locationsByCountries as $country => $locations) {
            $jobsByCountries[$country] = $this->getJobIdsByLocationIds($locations);
        }

        return $jobsByCountries;
    }

    private function getJobIdsByLocationIds($locations)
    {
        return DB::table('job_location')->whereIn('location_id', $locations)->pluck('job_id')->toArray();
    }

    private function getJobCountByFocus($focus, $jobs)
    {
        return DB::table('focus_job')->whereIn('job_id', $jobs)->whereIn('focus_id', $focus)->groupBy('focus_id')->select(DB::raw('count(job_id) as jobs, focus_id'))->get();
    }

    private function buildJobByFocusData($jobsByCountries)
    {
        $countryFocusCount = [];

        foreach ($jobsByCountries as $country => $jobs) {
            $countryFocusCount[$country] = $this->buildItemResultEntry($this->getJobCountByFocus($this->focusIds, $jobs));
            $countryFocusCount[$country]['Total'] = count($jobs);
        }

        return $countryFocusCount;
    }

    private function buildItemResultEntry($focusCounts)
    {
        $mappedFocusCount = [];

        foreach ($this->focusNames as $focusId => $focusName) {
            $mappedFocusCount[$focusName] = $this->getFocusCount($focusId, $focusCounts);
        }

        return $mappedFocusCount;
    }

    private function getFocusCount($focusId, $focusCounts)
    {
        foreach ($focusCounts as $focusCount) {
            if ($focusCount->focus_id === $focusId) {
                return $focusCount->jobs;
            }
        }

        return 0;
    }
}
