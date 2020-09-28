<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CompaniesByFocus extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = DB::table('company_focus')
            ->select('focus.name', DB::raw('COUNT(company_focus.company_id) as total'))
            ->join('focus', 'focus.id', '=', 'company_focus.focus_id')
            ->groupBy('company_focus.focus_id')
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
