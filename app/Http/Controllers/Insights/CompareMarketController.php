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
        return $query;
    }
}
