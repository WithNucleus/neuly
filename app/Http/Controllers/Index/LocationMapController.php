<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Location;

class LocationMapController extends Controller
{
    /**
     * Show
     * @return \Illuminate\View\View
     */
    public function show()
    {

        $locations = Location::whereNotNull('alpha2code')
            ->withCount(['companies', 'people', 'investors', 'jobs', 'events', 'clinicaltrials'])
            ->orderBy('country')
            ->get()
            ->groupBy('alpha2code')
            ->toArray();

        $countriesByCode = $this->getMappedCountries($locations);

//        dump($locations, $countriesByCode);

        return view('discover.locations.map', compact('countriesByCode'));
    }

    private function getMappedCountries($country_groups)
    {
        $mappedArray = [];

        foreach($country_groups as $country_group) {

            $total = 0;
            $total_companies = 0;
            $total_people = 0;
            $total_investors = 0;
            $total_jobs = 0;
            $total_events = 0;
            $total_clinicaltrials = 0;

            foreach ($country_group as $location) {
                $total += $location['companies_count'] +
                         $location['people_count'] +
                         $location['investors_count'] +
                         $location['jobs_count'] +
                         $location['events_count'] +
                         $location['clinicaltrials_count'];

                $total_companies += $location['companies_count'];
                $total_people += $location['people_count'];
                $total_investors += $location['investors_count'];
                $total_jobs += $location['jobs_count'];
                $total_events += $location['events_count'];
                $total_clinicaltrials += $location['clinicaltrials_count'];
            }

            $mappedArray[$country_group[0]['alpha2code']] = [
                'country' => $country_group[0]['country'],
                'total' => $total,
                'companies' => $total_companies,
                'people' => $total_people,
                'investors' => $total_investors,
                'jobs' => $total_jobs,
                'events' => $total_events,
                'clinicaltrials' => $total_clinicaltrials,
            ];
        }

        return $mappedArray;
    }
}
