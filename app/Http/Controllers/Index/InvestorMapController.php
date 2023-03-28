<?php

namespace App\Http\Controllers\Index;

use App\Helpers\MapHelper;
use App\Http\Controllers\Controller;
use App\Models\Investor;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvestorMapController extends Controller
{
    public function showMap(Request $request)
    {
        $types = Investor::groupBy('type');
        $type_cats = $types->pluck('type');

        $types = $this->filterTypes($this->filterTypeValues($request), $types);
        $types = $types->get('type');

        $filters_hiring = [$this->filterHiringValue($request)];

        $sort = $this->getOrderDirection($this->getSortParameter($request));
        $countriesByCode = $this->getCountriesResultByCode($sort, $types, $filters_hiring[0]);

        $filtered_types = $types->pluck('type')->toArray();

        $path = route('discover.investors.map');

        return view('discover.investors.maps.global', compact('countriesByCode', 'path', 'sort', 'type_cats', 'filtered_types', 'filters_hiring'));
    }

    public function showCountry(Request $request, $country)
    {
        $types = Investor::groupBy('type');
        $type_cats = $types->pluck('type');

        $types = $this->filterTypes($this->filterTypeValues($request), $types);
        $types = $types->get('type');

        $sort = $this->getOrderDirection($this->getSortParameter($request));

        $filters_hiring = [$this->filterHiringValue($request)];

        $regionsByCode = $this->getCountryResult($country, $sort, $types, $filters_hiring[0]);

        $filtered_types = $types->pluck('type')->toArray();

        $path = route('discover.investors.map.country', $country);
        $map = MapHelper::getCountryMap($country);

        if (! $map['show']) {
            return abort(404);
        }

        return view('discover.investors.maps.country', compact('regionsByCode', 'path', 'sort', 'map', 'country', 'type_cats', 'filtered_types'));
    }

    /**
     * @return mixed
     */
    private function filterTypes($values, $query)
    {
        if ($values !== []) {
            $query = $query->whereIn('type', $values);
        }

        return $query;
    }

    /**
     * @return array|false|string[]
     */
    private function filterTypeValues($request)
    {
        $filters_focus = [];
        if ($this->filterHasTypes($request)) {
            $filters_focus = $this->getFilteredTypes($request->input('filter')['type']);
        }

        return $filters_focus;
    }

    private function filterHiringValue($request)
    {
        if ($this->filterHasHiring($request)) {
            return $request->input('filter')['hiring'];
        }

        return 'Both';
    }

    /**
     * @return bool
     */
    private function filterHasTypes($request)
    {
        return $request->has('filter') && array_key_exists('type', $request->input('filter'));
    }

    private function filterHasHiring($request)
    {
        return $request->has('filter') && array_key_exists('hiring', $request->input('filter'));
    }

    /**
     * @return false|string[]
     */
    private function getFilteredTypes($filter)
    {
        return explode('|', $filter);
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
    private function getInvestorsByCountries($locationsByCountries)
    {
        $investorsByCountry = [];
        foreach ($locationsByCountries as $alpha2code => $country) {
            $investorsByCountry[$alpha2code]['name'] = $country['name'];
            $investorsByCountry[$alpha2code]['investors'] = $this->getInvestorsByLocations($country['locations']);
        }

        return $investorsByCountry;
    }

    /**
     * @return mixed
     */
    public function getInvestorsByRegions($locationsByRegions)
    {
        $investorsByRegion = [];
        foreach ($locationsByRegions as $region_code => $region) {
            $investorsByRegion[$region_code]['name'] = $region['name'];
            $investorsByRegion[$region_code]['investors'] = $this->getInvestorsByLocations($region['locations']);
        }

        return $investorsByRegion;
    }

    /**
     * @return array
     */
    private function getInvestorsByLocations($locations)
    {
        return DB::table('investor_location')
            ->whereIn('location_id', $locations)
            ->pluck('investor_id')
            ->toArray();
    }

    private function getHiringInvestors($investors)
    {
        return DB::table('jobs')
            ->whereIn('owner_id', $investors)
            ->where('owner_type', Investor::class)
            ->pluck('owner_id')
            ->unique()
            ->toArray();
    }

    /**
     * @param $jobsByCountries
     * @param $focus
     * @return array
     */
    private function getInvestorMappingByCountriesAndFocus($investorsByCountries, $types, $hiring)
    {
        $investorsByCountriesAndTypes = [];
        foreach ($investorsByCountries as $alpha2code => $country) {
            $count = count($country['investors']);
            $hiringCount = count($this->getHiringInvestors($country['investors']));
            if ($count && $this->addByHiringFilter($hiring, $hiringCount)) {
                $investorsByCountriesAndTypes[$alpha2code]['name'] = $country['name'];
                $investorsByCountriesAndTypes[$alpha2code]['hiring'] = $hiringCount;
                $investorsByCountriesAndTypes[$alpha2code]['total'] = $count;

                foreach ($types as $item) {
                    $investorsByCountriesAndTypes[$alpha2code]['types'][$item->type] = $this->countInvestorsByType($country['investors'], $item->type);
                }
            }
        }

        return $investorsByCountriesAndTypes;
    }

    private function getInvestorMappingByRegionsAndFocus($investorsByRegions, $types, $hiring)
    {
        $investorsByRegionsAndTypes = [];
        foreach ($investorsByRegions as $region_code => $region) {
            $count = count($region['investors']);
            $hiringCount = count($this->getHiringInvestors($region['investors']));
            if ($count && $this->addByHiringFilter($hiring, $hiringCount)) {
                $investorsByRegionsAndTypes[$region_code]['name'] = $region['name'];
                $investorsByRegionsAndTypes[$region_code]['hiring'] = $hiringCount;
                $investorsByRegionsAndTypes[$region_code]['total'] = $count;

                foreach ($types as $item) {
                    $investorsByRegionsAndTypes[$region_code]['types'][$item->type] = $this->countInvestorsByType($region['investors'], $item->type);
                }
            }
        }

        return $investorsByRegionsAndTypes;
    }

    private function countInvestorsByType($investors, $type)
    {
        return DB::table('investors')
            ->whereIn('id', $investors)
            ->where('type', '=', $type)
            ->selectRaw('COUNT(id) as investors')->get('inestors')->toArray()[0]->investors;
    }

    /**
     * @return array
     */
    private function getCountriesResultByCode($sort, $types, $hiring)
    {
        $locationsByCountries = Location::byCountries($sort);
        $investorsByCountries = $this->getInvestorsByCountries($locationsByCountries);

        return $this->getInvestorMappingByCountriesAndFocus($investorsByCountries, $types, $hiring);
    }

    private function getCountryResult($country, $sort, $types, $hiring)
    {
        $locations = Location::byRegions($country, $sort);
        $investorsByRegions = $this->getInvestorsByRegions($locations);

        return $this->getInvestorMappingByRegionsAndFocus($investorsByRegions, $types, $hiring);
    }

    private function addByHiringFilter($filter, $count)
    {
        return $filter === 'Both' || ($filter === 'Yes' && $count > 0) || ($filter === 'No' && $count === 0);
    }
}
