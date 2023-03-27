<?php

namespace App\Http\Controllers\Insights;

use App\Helpers\InsightsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class JobsByFocusController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = DB::table('focus_job')
            ->select('focus.name', DB::raw('COUNT(focus_job.job_id) as total'))
            ->join('focus', 'focus.id', '=', 'focus_job.focus_id')
            ->groupBy('focus_job.focus_id');
        $query = $this->filterQuery($query, $request);
        $data = $query->get();

        $response = [
            'labels' => $data->pluck('name'),
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
        if ($request->has('focus')) {
            $query = $this->filterByFocus($query, $request->input('focus'));
        }

        return $query;
    }

    /**
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByFocus($query, $value)
    {
        return $query->where('focus.name', $value);
    }
}
