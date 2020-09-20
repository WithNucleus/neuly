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
        $items = $query->get();
        $countries = $this->getMappedFocusByCountry($items);
        $countriesByCode = $this->getMappedFocusByCountryCode($items, $countries);

        return response($countriesByCode, Response::HTTP_OK);
    }

    public function show()
    {
        $query = $this->buildCountryQuery();
        $items = $query->get();
        $countriesByCode = $this->getMappedCountries($items);

        return view('discover.insights.distribution.show', compact('countriesByCode'));
    }

    public function showWithFocus()
    {
        $query = $this->buildCountryByFocusQuery();
        $items = $query->get();
        $countries = $this->getMappedFocusByCountry($items);
        $countriesByCode = $this->getMappedFocusByCountryCode($items, $countries);

        return view('discover.insights.distribution.show', compact('countriesByCode'));
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
            ->join('clinicaltrial_location', 'locations.id', 'clinicaltrial_location.location_id')
            ->join('countries', 'locations.country', 'countries.name');
    }

    private function joinFocus($query)
    {
        return $query->join('clinicaltrial_focus', 'clinicaltrial_location.clinicaltrial_id', 'clinicaltrial_focus.clinicaltrial_id')
                    ->join('focus', 'focus.id', 'clinicaltrial_focus.focus_id');
    }

    private function selectByCountries($query)
    {
        return $query->select('country', 'alpha2code',
            DB::raw('count(clinicaltrial_location.clinicaltrial_id) as trials'));
    }

    private function selectByCountriesAndFocus($query)
    {
        return $query->select('country', 'focus.name', 'alpha2code',
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

    private function getMappedCountries($items)
    {
        $mappedArray = [];

        foreach($items as $item) {
            $mappedArray[$item->alpha2code] = [
                'country' => $item->country,
                'total' => $item->trials
            ];
        }

        return $mappedArray;
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

    private function getMappedFocusByCountryCode($items, $countries)
    {
        $mappedArray = [];

        foreach($items as $item)
        {
            $mappedArray[$item->alpha2code] = [
                'country' => $item->country,
                'focus' => $countries[$item->country],
                'total' => $this->getTotalTrialsOfCountry($countries[$item->country]),
            ];
        }

        return $mappedArray;
    }

    private function getTotalTrialsOfCountry($items)
    {
        $total = 0;
        foreach($items as $item)
        {
            $total += $item['trials'];
        }

        return $total;
    }



}
