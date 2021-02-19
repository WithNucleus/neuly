<?php

namespace App\Http\Controllers\Index;

use App\Helpers\MapHelper;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvestorMapController extends Controller
{
    public function showMap(Request $request)
    {
        $sort = $this->getOrderDirection($this->getSortParameter($request));
        $countriesByCode = $this->getCountriesResultByCode($sort);

        $path = route('discover.investors.map');

        return view('discover.investors.maps.global', compact('countriesByCode', 'path', 'sort'));
    }

    public function showCountry(Request $request, $country)
    {
        $sort = $this->getOrderDirection($this->getSortParameter($request));

        $regionsByCode = $this->getCountryResult($country, $sort);

        $path = route('discover.investors.map.country', $country);
        $map = MapHelper::getCountryMap($country);

        return view('discover.investors.maps.country', compact('regionsByCode', 'path', 'sort', 'map', 'country'));
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
    private function getInvestorsByCountries($locationsByCountries)
    {
        $investorsByCountry = [];
        foreach ($locationsByCountries as $alpha2code => $country) {
            $investorsByCountry[$alpha2code]['name'] = $country['name'];
            $investorsByCountry[$alpha2code]['total'] = count($this->getInvestorsByLocations($country['locations']));
        }

        return $investorsByCountry;
    }

    /**
     * @param $locationsByRegions
     * @return mixed
     */
    public function getInvestorsByRegions($locationsByRegions)
    {
        $investorsByRegion = [];
        foreach ($locationsByRegions as $region_code => $region) {
            $investorsByRegion[$region_code]['name'] = $region['name'];
            $investorsByRegion[$region_code]['total'] = count($this->getInvestorsByLocations($region['locations']));
        }

        return $investorsByRegion;
    }

    /**
     * @param $locations
     * @return array
     */
    private function getInvestorsByLocations($locations)
    {
        return DB::table('investor_location')
            ->whereIn('location_id', $locations)
            ->pluck('investor_id')
            ->toArray();
    }

    /**
     * @param $sort
     * @return array
     */
    private function getCountriesResultByCode($sort)
    {
        $locationsByCountries = Location::byCountries($sort);

        return $this->getInvestorsByCountries($locationsByCountries);
    }

    private function getCountryResult($country, $sort)
    {
        $locations = Location::byRegions($country, $sort);
        $investorsByRegions = $this->getInvestorsByRegions($locations);

        return $this->getInvestorsByRegions($locations);
    }
}
