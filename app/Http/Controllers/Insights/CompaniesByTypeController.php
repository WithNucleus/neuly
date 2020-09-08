<?php

namespace App\Http\Controllers\Insights;

use App\Helpers\InsightsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $data  = $query->get();

        $response = [
            'labels' => $data->pluck('ownership'),
            'values' => $data->pluck('total'),
            'colors' => InsightsHelper::getChartColors($data->count()),
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterQuery($query, $request)
    {
        $ownershipFilter = ['Privately Held', 'Public Company', 'Non-Profit'];

        if ($request->has('ownership')) {
            $ownershipFilter = is_array($request->input('ownership')) ?
                $request->input('ownership') : [$request->input('ownership')];
        }

        $query = $this->filterByOwnership($query, $ownershipFilter);

        return $query;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $value
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByOwnership($query, $values)
    {

        return $query->whereIn('ownership', $values);
    }
}
