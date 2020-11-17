<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompareMarketController extends Controller
{
    public function show(Request $request) {
        $query = $this->getQuery();
        $query = $this->getRelatedData($query);
        $query = $this->filterQuery($query, $request);
        $companies = $query->get();

        return view('discover.insights.market-comparison.show', compact('companies'));
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
        //filter by valuation
        if($request->has('valuation')) {
            $query = $this->filterByValuation($query, $request->input('valuation'));
        }
        if($request->has('locations')) {
            $query = $this->filterByLocation($query, $request->input('locations'));
        }
        if($request->has('focus')) {
            $query = $this->filterByFocus($query, $request->input('focus'));
        }
        if($request->has('founded')) {
            $query = $this->filterByFoundationYear($query, $request->input('founded'));
        }

        return $query;
    }

    private function filterByValuation($query, $request) {
        return $query;
    }

    private function filterByLocation($query, $values) {
        $query = $query->whereHas('locations', function($q) use ($values) {
            $q->whereIn('country', $values);
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

}
