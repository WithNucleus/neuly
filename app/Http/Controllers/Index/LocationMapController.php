<?php

namespace App\Http\Controllers\Index;

use App\Helpers\MapHelper;
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
        $filter_array = $this->filterRequest($request);
        $filters_type = $filter_array['filters_type'];
        $all_filters_type = $filter_array['all_filters_type'];

        $locationsQuery = Location::whereNotNull('alpha2code');
        $locationsQuery = $this->filterQuery($locationsQuery, $filter_array['filter']);

        $locations = $locationsQuery
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
        $filter_array = $this->filterRequest($request);
        $filters_type = $filter_array['filters_type'];
        $all_filters_type = $filter_array['all_filters_type'];

        $locationsQuery = Location::where('country', $country);
        $locationsQuery = $this->filterQuery($locationsQuery, $filter_array['filter']);

        $locations = $locationsQuery
            ->orderBy('region')
            ->get()
            ->groupBy('region')
            ->toArray();

        $countriesByCode = $this->getMappedLocationGroups($locations, 'region');

        $path = route('discover.locations.maps.country', $country);
        $sort = $request->has('sort') ? $request->input('sort') : 'organizations';

        $map = MapHelper::getCountryMap($country);

        return view('discover.locations.maps.country', compact('country', 'map', 'locations', 'countriesByCode', 'all_filters_type', 'filters_type', 'path', 'sort'));
    }

    private function filterRequest($request)
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

        return [
            'filter' => $filter,
            'filters_type' => $filters_type,
            'all_filters_type' => $all_filters_type
        ];
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

    private function getEntityCount($entity_count, $location, $country_count)
    {
        if (array_key_exists($entity_count, $location)) {
            $country_count['total'] += $location[$entity_count];
            $country_count[$entity_count] += $location[$entity_count];
        }

        return $country_count;
    }

    private function getMappedLocationGroups($country_groups, $groupBy)
    {
        $mappedArray = [];

        foreach($country_groups as $country_group) {

            $country_count = [
                'total' => 0,
                'companies_count' => 0,
                'people_count' => 0,
                'investors_count' => 0,
                'jobs_count' => 0,
                'events_count' => 0,
                'clinicaltrials_count' => 0,
            ];

            foreach ($country_group as $location) {
                $country_count = $this->getEntityCount('companies_count', $location, $country_count);
                $country_count = $this->getEntityCount('people_count', $location, $country_count);
                $country_count = $this->getEntityCount('investors_count', $location, $country_count);
                $country_count = $this->getEntityCount('jobs_count', $location, $country_count);
                $country_count = $this->getEntityCount('events_count', $location, $country_count);
                $country_count = $this->getEntityCount('clinicaltrials_count', $location, $country_count);
            }

            // Labels by Group Type
            if ($groupBy == 'alpha2code') {
                $label = $country_group[0]['country'];
                $label_code = $country_group[0]['alpha2code'];
            } else {
                if ($country_group[0]['region'] != '') {
                    $label = $country_group[0]['region'];
                    if ($country_group[0]['region_code'] != '') {
                        $label_code = $country_group[0]['region_code'];
                    } else {
                        $label_code = $country_group[0]['region'];
                    }
                } else {
                    $label = $country_group[0]['country'];
                    $label_code = $country_group[0]['country'];
                }
            }

            if ($country_count['total'] != 0) {
                $mappedArray[$label_code] = [
                    'country' => $label,
                    'total' => $country_count['total'],
                    'organizations' => $country_count['companies_count'],
                    'people' => $country_count['people_count'],
                    'investors' => $country_count['investors_count'],
                    'jobs' => $country_count['jobs_count'],
                    'events' => $country_count['events_count'],
                    'clinical trials' => $country_count['clinicaltrials_count'],
                ];
            }
        }

        return $mappedArray;
    }
}
