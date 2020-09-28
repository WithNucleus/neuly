<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ResearchByFocus extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = DB::table('focus_research')
            ->select('focus.name', DB::raw('COUNT(focus_research.research_id) as total'))
            ->join('focus', 'focus.id', '=', 'focus_research.focus_id')
            ->groupBy('focus_research.focus_id')
            ->get();

        $response = [
            "chart" => [
                "labels" => $data->pluck('name'),
            ],
            "datasets" => [
                [
                    "name" => "Number of Research",
                    "values" => $data->pluck('total')
                ]
            ]
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
