<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LocationTopByJobsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = DB::table('job_location')
            ->select([
                'locations.id', 'locations.name', 'locations.slug',
                DB::raw('COUNT(job_location.job_id) AS total'),
            ])
            ->join('locations', 'locations.id', '=', 'job_location.location_id')
            ->groupBy('locations.id')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();

        if ($data !== []) {
            $maxTotal = $data[0]->total;

            foreach ($data as $key => $item) {
                $data[$key]->percent = round(round($item->total / $maxTotal, 2) * 100 / 5);
                $data[$key]->link = route('discover.locations.show', $item->slug);
            }
        }

        return response()->json($data, Response::HTTP_OK);
    }
}
