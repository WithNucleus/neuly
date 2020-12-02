<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CompareMarketController extends Controller
{
    public function show(Request $request) {
        $query = $this->getQuery();
        $query = $this->getRelatedData($query);

        $path = route('insights.compare-market');
        $sort = $request->has('sort') ? $request->input('sort') : 'organizations';

        $focuses = $this->getRelatedFocuses();

        $foundationYears = $this->getProcessedFoundationYears();

        $valuation_min = $this->getValuationMinValue();
        $valuation_max = $this->getValuationMaxValue();

        $filters_location = [];
        $filters_focus = [];
        $filters_foundation_years = [];
        $filters_type = [];

        $filters_valuation_min = $valuation_min;
        $filters_valuation_max =  $valuation_max;

        if ($request->has('filter')) {
            $filter = $this->getFilterValues($request->input('filter'));

            $query = $this->filterQuery($query, $filter);

            $filters_location = $this->getFilteredLocations($filter);
            $filters_focus = $this->getFilteredFOcus($filter);
            $filters_type = $this->getFilteredType($filter);
            $filters_foundation_years = $this->getFilteredFoundationYears($filter);

            if(array_key_exists('valuation_min', $filter) && array_key_exists('valuation_max', $filter)) {
                $filters_valuation_min = $filter['valuation_min'][0];
                $filters_valuation_max =  $filter['valuation_max'][0];
            }
        }

        $companies = $this->sortQuery($query, $sort)->get();

        return view('discover.insights.market-comparison.show', compact(
            'companies',
            'path',
            'sort',
            'focuses',
            'foundationYears',
            'filters_location',
            'filters_focus',
            'filters_foundation_years',
            'filters_type',
            'valuation_min',
            'valuation_max',
            'filters_valuation_min',
            'filters_valuation_max'

        ));
    }

    private function getQuery()
    {
        return Company::select('id', 'name', 'logo', 'slug', 'ownership', 'valuation', 'founded_date');
    }

    private function getRelatedData($query)
    {
        return $query->with(['investors', 'people', 'locations', 'valuations', 'focus']);
    }

    private function filterQuery($query, $request)
    {
        if(array_key_exists('valuation_min', $request) && array_key_exists('valuation_max', $request)) {
            $query = $this->filterByValuation($query, $request['valuation_min'][0], $request['valuation_max'][0]);
        }
        if(array_key_exists('locations', $request)) {
            $query = $this->filterByLocation($query, $request['locations']);
        }
        if(array_key_exists('focus', $request)) {
            $query = $this->filterByFocus($query, $request['focus']);
        }
        if(array_key_exists('foundation_year', $request)) {
            $query = $this->filterByFoundationYear($query, $request['foundation_year']);
        }
        if(array_key_exists('type', $request)) {
            $query = $this->filterByType($query, $request['type']);
        }

        return $query;
    }

    private function filterByValuation($query, $min, $max) {
        return $query->where('valuation', '>=', $min)
                ->where('valuation', '<=', $max);
    }

    private function filterByLocation($query, $values) {
        $query = $query->whereHas('locations', function($q) use ($values) {
            $firstElement = true;

            foreach($values as $value)
            {
                if($firstElement)
                {
                    $q->where('locations.name', 'LIKE',  '%'.$value.'%');
                    $firstElement = false;
                } else {
                    $q->orWhere('locations.name', 'LIKE',  '%'.$value.'%');
                }
            }
        });

        return $query;
    }

    private function filterByFocus($query, $values) {
        $query = $query->whereHas('focus', function($q) use ($values) {
            $q->whereIn('name', $values);
        });
        return $query;
    }

    private function filterByType($query, $values) {
        foreach ($values as $type) {
            $query->orWhere('ownership', $type);
        }
        return $query;
    }

    private function filterByFoundationYear($query, $values) {
        $firstElement = true;

        foreach($values as $value) {
            if($firstElement) {
                $query = $this->getFoundedYearWhereClause($value, $query);
                $firstElement = false;
            } else {
                $query = $this->getFoundedYearOrWhereClause($value, $query);
            }
        }

        return $query;
    }

    private function sortQuery($query, $sort)
    {
        $direction = strpos($sort, '-') !== false ? 'desc' : 'asc';
        $sortType = str_replace('-', '', $sort);

        switch ($sortType) {
            case 'organizations':
            default:
                $orderField = 'name';
                break;
        }

        $query->orderBy($orderField, $direction);

        return $query;
    }

    private function getProcessedFoundationYears()
    {
        return $this->processFoundationYears($this->getRelatedFoundationYears());
    }

    private function getRelatedFoundationYears()
    {
        return Company::selectRaw('YEAR(founded_date) as foundation_year')
            ->orderBy('foundation_year')
            ->pluck('foundation_year')
            ->unique();
    }

    private function processFoundationYears($foundationYearsRaw)
    {
        $foundationYears = new Collection();

        foreach($foundationYearsRaw as $year) {
            if($year == null) {
                $year = 'unknown';
            }

            $foundationYears->push($year);
        }

        return $foundationYears;
    }

    private function getFilterValues($filterRequestValues)
    {
        $filterInput = $filterRequestValues;

        $filter = array_map(function ($entity) {
            return explode('|', $entity);
        }, $filterInput);

        return $filter;
    }

    private function getRelatedFocuses()
    {
        return Focus::whereHas('companies')
            ->orderBy('name')
            ->pluck('name')
            ->unique();
    }

    private function getFilteredLocations($filter)
    {
        return isset($filter['locations']) ? $filter['locations'] : [];
    }

    private function getFilteredFocus($filter)
    {
        return isset($filter['focus']) ? $filter['focus'] : [];
    }

    private function getFilteredType($filter)
    {
        return isset($filter['type']) ? $filter['type'] : [];
    }

    private function getFilteredFoundationYears($filter)
    {
        return isset($filter['foundation_year']) ? $filter['foundation_year'] : [];
    }

    private function getFoundedYearWhereClause($value, $query)
    {
        return ($value === 'unknown') ? $query->whereNull('founded_date') : $query->whereRaw('YEAR(founded_date) = ?', $value);
    }

    private function getFoundedYearOrWhereClause($value, $query)
    {
        return ($value === 'unknown') ? $query->orWhereNull('founded_date') : $query->orWhereRaw('YEAR(founded_date) = ?', $value);
    }

    private function getValuationMinValue()
    {
        return Company::whereNotNull('valuation')->select('valuation')->orderBy('valuation', 'asc')->first()->valuation;
    }

    private function getValuationMaxValue()
    {
        return Company::whereNotNull('valuation')->select('valuation')->orderBy('valuation', 'desc')->first()->valuation;
    }
}
