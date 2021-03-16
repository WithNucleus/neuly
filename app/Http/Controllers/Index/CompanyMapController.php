<?php

namespace App\Http\Controllers\Index;

use App\Helpers\MapHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanyMapController extends Controller
{
    /**
     * Show.
     * @return \Illuminate\View\View
     */
    public function showMap(Request $request)
    {
        $focus = Focus::hasCompanies()->orderBy('name');
        $focus_cats = $focus->pluck('name')->toArray();

        $focus = $this->filterFocus($this->filterFocusValues($request), $focus);
        $focus = $focus->get();

        $filters_type = [];

        if ($this->filterHasType($request)) {
            $filters_type = $this->getFilteredOptions($request->input('filter')['type']);
        }

        $companies = $this->getCompaniesByTypes($filters_type);

        $sort = $this->getOrderDirection($this->getSortParameter($request));
        $countriesByCode = $this->getCountriesResultByCode($sort, $focus, $companies);

        $filters_focus = $focus->pluck('name')->toArray();

        $path = route('discover.organizations.map');

        return view('discover.organizations.maps.global', compact('countriesByCode', 'filters_focus', 'focus_cats', 'path', 'sort', 'filters_type'));
    }

    /**
     * @param Request $request
     * @param $country
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showCountry(Request $request, $country)
    {
        $focus = Focus::hasCompanies()->orderBy('name');
        $focus_cats = $focus->pluck('name')->toArray();

        $focus = $this->filterFocus($this->filterFocusValues($request), $focus);
        $focus = $focus->get();

        $filters_type = null;

        if ($this->filterHasType($request)) {
            $filters_type = $this->getFilteredOptions($request->input('filter')['type']);
        }

        $companies = $this->getCompaniesByTypes($filters_type);

        $sort = $this->getOrderDirection($this->getSortParameter($request));

        $regionsByCode = $this->getCountryResult($country, $sort, $focus, $companies);

        $filters_focus = $focus->pluck('name')->toArray();
        $path = route('discover.organizations.map.country', $country);
        $map = MapHelper::getCountryMap($country);

        if (! $map['show']) {
            return abort(404);
        }

        return view('discover.organizations.maps.country', compact('regionsByCode', 'filters_focus', 'focus_cats', 'path', 'sort', 'map', 'country'));
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
            $filters_focus = $this->getFilteredOptions($request->input('filter')['focus']);
        }

        return $filters_focus;
    }

    /**
     * @param $filter
     * @return false|string[]
     */
    private function getFilteredOptions($filter)
    {
        return explode('|', $filter);
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
     * @param $request
     * @return bool
     */
    private function filterHasType($request)
    {
        return $request->has('filter') && array_key_exists('type', $request->input('filter'));
    }

    /**
     * @param $filter
     * @return array
     */
    private function filteredTypeToArray($filter)
    {
        return $filter !== null ? [$filter] : [];
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
     * @param $locations
     * @return array
     */
    private function getCompaniesByLocations($locations, $companies)
    {
        return DB::table('company_location')
                ->whereIn('location_id', $locations)
                ->whereIn('company_id', $companies)
                ->pluck('company_id')
                ->toArray();
    }

    private function getCompaniesByTypes($types = null)
    {
        $companies = [];

        if ($types !== null && $types !== []) {
            $companies = Company::whereIn('ownership', $types)
                ->pluck('id')
                ->toArray();
        } else {
            $companies = Company::all()->pluck('id')->toArray();
        }

        return $companies;
    }

    /**
     * @param $locationsByCountries
     * @return array
     */
    private function getCompaniesByCountries($locationsByCountries, $companies)
    {
        $jobsByCountry = [];
        foreach ($locationsByCountries as $alpha2code => $country) {
            $jobsByCountry[$alpha2code]['name'] = $country['name'];
            $jobsByCountry[$alpha2code]['companies'] = $this->getCompaniesByLocations($country['locations'], $companies);
        }

        return $jobsByCountry;
    }

    private function getCompaniesByRegions($locationsByRegions, $companies)
    {
        $companiesByRegion = [];
        foreach ($locationsByRegions as $region_code => $region) {
            $companiesByRegion[$region_code]['name'] = $region['name'];
            $companiesByRegion[$region_code]['companies'] = $this->getCompaniesByLocations($region['locations'], $companies);
        }

        return $companiesByRegion;
    }

    /**
     * @param $jobsByCountries
     * @param $focus
     * @return array
     */
    private function getCompaniesMappingByCountriesAndFocus($companiesByCountries, $focus)
    {
        $companiesByCountriesAndFocus = [];

        foreach ($companiesByCountries as $alpha2code => $country) {
            $companiesByCountriesAndFocus[$alpha2code]['name'] = $country['name'];
            $companiesByCountriesAndFocus[$alpha2code]['total'] = count($country['companies']);

            foreach ($focus as $item) {
                $companiesByCountriesAndFocus[$alpha2code]['focus'][$item->name] = $this->countCompaniesByFocus($country['companies'], $item->id);
            }
        }

        return $companiesByCountriesAndFocus;
    }

    private function getCompaniesMappingByRegionAndFocus($companiesByRegion, $focus)
    {
        $companiesByRegionsAndFocus = [];
        foreach ($companiesByRegion as $region_code => $region) {
            $companiesByRegionsAndFocus[$region_code]['name'] = $region['name'];
            $companiesByRegionsAndFocus[$region_code]['total'] = count($region['companies']);

            foreach ($focus as $item) {
                $companiesByRegionsAndFocus[$region_code]['focus'][$item->name] = $this->countCompaniesByFocus($region['companies'], $item->id);
            }
        }

        return $companiesByRegionsAndFocus;
    }

    private function countCompaniesByFocus($companies, $focus)
    {
        return DB::table('company_focus')
                ->whereIn('company_id', $companies)
                ->where('focus_id', '=', $focus)
                ->selectRaw('COUNT(company_id) as companies')->get('companise')->toArray()[0]->companies;
    }

    /**
     * @param $sort
     * @param $focus
     * @return array
     */
    private function getCountriesResultByCode($sort, $focus, $companies)
    {
        $locationsByCountries = Location::byCountries($sort);
        $companiesByCountries = $this->getCompaniesByCountries($locationsByCountries, $companies);

        return $this->getCompaniesMappingByCountriesAndFocus($companiesByCountries, $focus);
    }

    public function getCountryResult($country, $sort, $focus, $companies)
    {
        $locations = Location::byRegions($country, $sort);
        $companiesByRegions = $this->getCompaniesByRegions($locations, $companies);

        return $this->getCompaniesMappingByRegionAndFocus($companiesByRegions, $focus);
    }
}
