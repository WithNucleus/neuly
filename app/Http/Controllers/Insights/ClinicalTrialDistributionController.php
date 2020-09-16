<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClinicalTrialDistributionController extends Controller
{
    public function index()
    {
        $query = $this->buildCountryByFocusQuery();
        $result = $this->getMappedFocusByCountry($query->get());

        return response($result, Response::HTTP_OK);
    }

    private function buildCountryQuery()
    {
        $query = $this->getQuery();
        $query = $this->selectByCountries($query);
        $query = $this->groupByCountries($query);

        return $query;
    }

    private function buildCountryByFocusQuery()
    {
        $query = $this->getQuery();
        $query = $this->joinFocus($query);
        $query = $this->selectByCountriesAndFocus($query);
        $query = $this->groupByCountriesAndFocus($query);

        return $query;
    }

    private function getQuery()
    {
        return DB::table('locations')
            ->join('clinicaltrial_location', 'locations.id', 'clinicaltrial_location.location_id');
    }

    private function joinFocus($query)
    {
        return $query->join('clinicaltrial_focus', 'clinicaltrial_location.clinicaltrial_id', 'clinicaltrial_focus.clinicaltrial_id')
                    ->join('focus', 'focus.id', 'clinicaltrial_focus.focus_id');
    }

    private function selectByCountries($query)
    {
        return $query->select('country',
            DB::raw('count(clinicaltrial_location.clinicaltrial_id) as trials'));
    }

    private function selectByCountriesAndFocus($query)
    {
        return $query->select('country', 'focus.name',
            DB::raw('count(clinicaltrial_location.clinicaltrial_id) as trials'));
    }

    private function groupByCountries($query)
    {
        return $query->groupBy('locations.country');
    }

    private function groupByCountriesAndFocus($query)
    {
        return $query->groupBy('focus.name', 'locations.country');
    }

    private function getMappedFocusByCountry($items)
    {
        return $items->mapToGroups(function($item, $key) {
            return [$item->country => [
                'name' => $item->name,
                'trials' => $item->trials
            ]];
        });
    }





}
