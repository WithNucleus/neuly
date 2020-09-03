<?php

namespace App\Http\Controllers\Insights;

use App\Helpers\InsightsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsByFocusController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = DB::table('focus_job')
            ->select('focus.name', DB::raw('COUNT(focus_job.job_id) as total'))
            ->join('focus', 'focus.id', '=','focus_job.focus_id')
            ->groupBy('focus_job.focus_id');

        $query = $this->filterQuery($query, $request);

        $data = $query->get()->toArray();

        $response = [
            'labels' => array_column($data,'name'),
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
        if($request->has('focus'))
        {
            $query = $this->filterByFocus($query, $request->input('focus'));
        }

        return $query;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByFocus($query, $value)
    {
        return $query->where('focus.name', $value);
    }
}
