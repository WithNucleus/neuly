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

        $map = $this->getCountryMap($country);

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

    /**
     * @param $country
     * @return array $map
     */
    private function getCountryMap(string $country)
    {
        $countries_with_maps = [
            'USA' => [
                'code' => 'US',
                'map_name' => 'us_merc',
            ],
            'Canada' => [
                'code' => 'CA',
                'map_name' => 'ca_lcc',
            ],
            'Australia' => [
                'code' => 'AU',
                'map_name' => 'au_mill',
            ],
            'Netherlands' => [
                'code' => 'NL',
                'map_name' => 'nl_merc'
            ],
            'Germany' => [
                'code' => 'DE',
                'map_name' => 'de_merc'
            ],
            'France' => [
                'code' => 'FR',
                'map_name' => 'fr_regions_2016_merc'
            ],
            'United Kingdom' => [
                'code' => 'UK',
                'map_name' => 'uk_countries_merc'
            ],
            'Austria' => [
                'code' => 'AT',
                'map_name' => 'at_merc'
            ],
            'Belgium' => [
                'code' => 'BE',
                'map_name' => 'be_merc'
            ],
            'China' => [
                'code' => 'CN',
                'map_name' => 'cn_merc'
            ],
            'Italy' => [
                'code' => 'IT',
                'map_name' => 'it_regions_merc'
            ],
            'Spain' => [
                'code' => 'ES',
                'map_name' => 'es_merc'
            ],
            'Switzerland' => [
                'code' => 'CH',
                'map_name' => 'ch_merc'
            ]
        ];

        if (array_key_exists($country, $countries_with_maps)) {
            $map = [
                'show' => true,
                'code' => $countries_with_maps[$country]['code'],
                'map_name' => $countries_with_maps[$country]['map_name']
            ];
        } else {
            $map = [
                'show' => false,
                'code' => '',
                'map_name' => ''
            ];
        }

        return $map;
    }

}
