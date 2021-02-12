<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class CompanyMapController extends Controller
{
    /**
     * Show.
     * @return \Illuminate\View\View
     */
    public function showMap(Request $request)
    {
        dd($this->getCountriesResultByCode('ASC', []));
    }


    private function getCompaniesByCountries($locationsByCountries)
    {
        return DB::table('company_location')
                ->whereIn('location_id', $locationsByCountries)
                ->pluck('company_id')
                ->toArray();
    }

    /**
     * @param $sort
     * @param $focus
     * @return array
     */
    private function getCountriesResultByCode($sort, $focus)
    {
        $locationsByCountries = Location::byCountries($sort);
        $companiesByCountries = $this->getCompaniesByCountries($locationsByCountries);

        return $companiesByCountries;
    }
}
