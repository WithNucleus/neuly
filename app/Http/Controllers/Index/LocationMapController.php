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
    public function showMap(Request $request)
    {
        $filter = [];
        $all_filters_type = [
            'organizations',
            'people',
            'investors',
            'clinical trials',
            'events',
            'jobs',
        ];
        $filters_type = [];

        if ($request->has('filter')) {
            $filterInput = $request->input('filter');

            $filter = array_map(function ($entity) {
                return explode('|', $entity);
            }, $filterInput);

            if (isset($filter['type'])) {
                $filters_type = $filter['type'];
            }
        } else {
            $filters_type = $all_filters_type;
        }

        $locations = Location::whereNotNull('alpha2code');

        $locations = $this->filterQuery($locations, $filter);

        $locations = $locations
            ->orderBy('country')
            ->get()
            ->groupBy('alpha2code')
            ->toArray();

        $countriesByCode = $this->getMappedLocationGroups($locations, 'alpha2code');

        $path = route('discover.locations.maps.global');
        $sort = $request->has('sort') ? $request->input('sort') : 'organizations';

        return view('discover.locations.maps.global', compact('countriesByCode', 'all_filters_type', 'filters_type', 'path', 'sort'));
    }

    /**
     * Show
     * @return \Illuminate\View\View
     */
    public function showCountry(Request $request, $country)
    {
        $filter = [];
        $all_filters_type = [
            'organizations',
            'people',
            'investors',
            'clinical trials',
            'events',
            'jobs',
        ];
        $filters_type = [];

        if ($request->has('filter')) {
            $filterInput = $request->input('filter');

            $filter = array_map(function ($entity) {
                return explode('|', $entity);
            }, $filterInput);

            if (isset($filter['type'])) {
                $filters_type = $filter['type'];
            }
        } else {
            $filters_type = $all_filters_type;
        }

        $locations = Location::where('country', $country);

        $locations = $this->filterQuery($locations, $filter);

        $locations = $locations
            ->orderBy('region')
            ->get()
            ->groupBy('region')
            ->toArray();

        $countriesByCode = $this->getMappedLocationGroups($locations, 'region');

        $path = route('discover.locations.maps.country', $country);
        $sort = $request->has('sort') ? $request->input('sort') : 'organizations';

        return view('discover.locations.maps.country', compact('country', 'locations', 'countriesByCode', 'all_filters_type', 'filters_type', 'path', 'sort'));
    }

    private function filterQuery($locations, $filter)
    {
        // type
        if(array_key_exists('type', $filter)) {
            foreach($filter['type'] as $type) {
                if ($type == 'organizations') {
                    $locations = $locations->withCount('companies');
                } elseif($type == 'clinical trials') {
                    $locations = $locations->withCount('clinicaltrials');
                } else {
                    $locations = $locations->withCount($type);
                }
            }
        } else {
            $locations = $locations->withCount(['companies', 'people', 'investors', 'jobs', 'events', 'clinicaltrials']);
        }

        return $locations;
    }

    private function getMappedLocationGroups($country_groups, $groupBy)
    {
        $mappedArray = [];

        foreach($country_groups as $country_group) {

            $total = 0;
            $map_count = 0;
            $total_companies = 0;
            $total_people = 0;
            $total_investors = 0;
            $total_jobs = 0;
            $total_events = 0;
            $total_clinicaltrials = 0;

            foreach ($country_group as $location) {

                if (array_key_exists('companies_count', $location)) {
                    $total += $location['companies_count'];
                    $total_companies += $location['companies_count'];
                }

                if (array_key_exists('people_count', $location)) {
                    $total += $location['people_count'];
                    $total_people += $location['people_count'];
                }

                if (array_key_exists('investors_count', $location)) {
                    $total += $location['investors_count'];
                    $total_investors += $location['investors_count'];
                }

                if (array_key_exists('jobs_count', $location)) {
                    $total += $location['jobs_count'];
                    $total_jobs += $location['jobs_count'];
                }

                if (array_key_exists('events_count', $location)) {
                    $total += $location['events_count'];
                    $total_events += $location['events_count'];
                }

                if (array_key_exists('clinicaltrials_count', $location)) {
                    $total += $location['clinicaltrials_count'];
                    $total_clinicaltrials += $location['clinicaltrials_count'];
                }

            }

            if ($groupBy == 'alpha2code') {
                $mappedArray[$country_group[0]['alpha2code']] = [
                    'country' => $country_group[0]['country'],
                    'map_count' => $map_count,
                    'total' => $total,
                    'organizations' => $total_companies,
                    'people' => $total_people,
                    'investors' => $total_investors,
                    'jobs' => $total_jobs,
                    'events' => $total_events,
                    'clinical trials' => $total_clinicaltrials,
                ];
            } else {
                if ($country_group[0]['region'] == '') {
                    $label_code = $country_group[0]['alpha2code'];
                    $label = $country_group[0]['country'];
                } else {
                    $label_code = $country_group[0]['region_code'];
                    $label = $country_group[0]['region'];
                }

                $mappedArray[$label_code] = [
                    'country' => $label,
                    'map_count' => $map_count,
                    'total' => $total,
                    'organizations' => $total_companies,
                    'people' => $total_people,
                    'investors' => $total_investors,
                    'jobs' => $total_jobs,
                    'events' => $total_events,
                    'clinical trials' => $total_clinicaltrials,
                ];
            }
        }

        return $mappedArray;
    }

}
