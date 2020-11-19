<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompareMarketController extends Controller
{
    public function show(Request $request) {
        $query = $this->getQuery();
        $query = $this->getRelatedData($query);

        $path = route('insights.compare-market');
        $sort = $request->has('sort') ? $request->input('sort') : 'organizations';

        $filters_location = [];
        $filters_focus = [];

        if ($request->has('filter')) {
            $filterInput = $request->input('filter');

            $filter = array_map(function ($entity) {
                return explode('|', $entity);
            }, $filterInput);

            $query = $this->filterQuery($query, $filter);

            if (isset($filter['locations'])) {
                $filters_location = $filter['locations'];
            }

            if (isset($filter['focus'])) {
                $filters_focus = $filter['focus'];
            }
        }

        $companies = $this->sortQuery($query, $sort)->get();

        return view('discover.insights.market-comparison.show', compact(
            'companies',
            'path',
            'sort',
            'filters_location'
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
        if(array_key_exists('valuation', $request)) {
            $query = $this->filterByValuation($query, $request['valuation']);
        }
        if(array_key_exists('locations', $request)) {
            $query = $this->filterByLocation($query, $request['locations']);
        }
        if(array_key_exists('focus', $request)) {
            $query = $this->filterByFocus($query, $request['focus']);
        }
        if(array_key_exists('founded', $request)) {
            $query = $this->filterByFoundationYear($query, $request['founded']);
        }

        return $query;
    }

    private function filterByValuation($query, $min, $max) {
        return $query;
    }

    private function filterByLocation($query, $values) {
        $query = $query->whereHas('locations', function($q) use ($values) {
            $q->whereIn('locations.name', $values);
        });

        return $query;
    }

    private function filterByFocus($query, $values) {
        $query = $query->whereHas('focus', function($q) use ($values) {
            $q->whereIn('name', $values);
        });
        return $query;
    }

    private function filterByFoundationYear($query, $value) {
        $query = $query->whereYear('founded_date', '>=', $value);
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
}
