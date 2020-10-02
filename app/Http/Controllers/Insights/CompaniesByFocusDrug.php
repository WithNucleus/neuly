<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CompaniesByFocusDrug extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = DB::table('company_focus')
            ->select('focus.name', DB::raw('COUNT(company_focus.company_id) as total'))
            ->join('focus', 'focus.id', '=', 'company_focus.focus_id')
            ->where('focus.type', Focus::TYPE_DRUG)
            ->groupBy('company_focus.focus_id')
            ->get();

        $response = [
            "chart" => [
                "labels" => $data->pluck('name'),
            ],
            "datasets" => [
                [
                    "name" => "Number of Companies",
                    "values" => $data->pluck('total')
                ]
            ]
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
