<?php

namespace App\Http\Controllers\Insights;

use App\Helpers\InsightsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class JobsByTypeController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = DB::table('jobs')
            ->select('employment_type', DB::raw('COUNT(id) as total'))
            ->groupBy('employment_type');
        $query = $this->filterQuery($query, $request);
        $data = $query->get();

        $response = [
            'labels' => $data->pluck('employment_type'),
            'values' => $data->pluck('total'),
            'colors' => InsightsHelper::getChartColors($data->count()),
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterQuery($query, $request)
    {
        if ($request->has('type')) {
            $query = $this->filterByType($query, $request->input('type'));
        }

        return $query;
    }

    /**
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByType($query, $value)
    {
        return $query->where('employment_type', $value);
    }
}
