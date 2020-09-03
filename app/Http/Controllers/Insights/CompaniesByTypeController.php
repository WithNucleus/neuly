<?php

namespace App\Http\Controllers\Insights;

use App\Helpers\InsightsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompaniesByTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = DB::table('companies')
            ->select('ownership', DB::raw('count(*) as total'))
            ->groupBy('ownership');

        $query = $this->filterQuery($query, $request);

        $data = $query->get()->toArray();

        $response = [
            'labels' => array_column($data,'ownership'),
            'values' => array_column($data,'total'),
            'colors' => InsightsHelper::getChartColors(count($data)),
        ];

        return response()->json($response);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterQuery($query, $request)
    {
        if($request->has('ownership')) {
            $query = $this->filterByOwnership($query, $request->input('ownership'));
        } else {
            //default scope
            $query->whereIn('ownership', ['Privately Held', 'Public Company', 'Non-Profit']);
        }

        return $query;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByOwnership($query, $value)
    {
        return $query->where('ownership', $value);
    }
}
