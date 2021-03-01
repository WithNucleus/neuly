<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClinicalTrialHistoric extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = DB::table('clinicaltrials')
            ->select(DB::raw('YEAR(start_date) AS year'), DB::raw('COUNT(*) as total'))
            ->whereNotNull('start_date')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $response = [
            'chart' => [
                'labels' => $data->pluck('year'),
            ],
            'datasets' => [
                [
                    'name' => 'Number of Clinical Trials',
                    'values' => $data->pluck('total'),
                ],
            ],
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
