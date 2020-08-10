<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Focus;
use App\Models\Company;
use App\Models\Location;

class ChartController extends Controller
{

	// Company Focus Chart
    public function companyFocus() {

        $categories = [
            'Psilocybin',
            'MDMA',
            'LSD',
            'DMT',
			'Tryptamine',
			'Ketamine',
			'Ibogaine',
			'GHB',
        ];

        $counts = [];

        foreach ($categories as $category) {

            // Get focus_id
            $focus_id = Focus::where('name', $category)->first()->id;

            // Get count
            $count = DB::table('company_focus')
                ->where('focus_id', $focus_id)
                ->count();

            // Add to $counts
            array_push($counts, $count);
        }

        // Chart Array
        $chart = array(
            "chart" => array(
                "labels" => $categories,
            ),
            "datasets" => array(
                [
                    "name" => "Number of Organizations",
                    "values" => $counts
                ]
            )
        );

        // Convert to json
        $chart_json = json_encode($chart);

        // Return $chart_json
        return $chart_json;
    }

    // Company Type Pie Chart
    /* Not currently in use because Sydney couldn't figure out how to color the chartisan pie chart */
    public function companyType() {

    	$type_counts = DB::table('companies')
    			->where('ownership', 'Privately Held')
    			->orWhere('ownership', 'Public Company')
    			->orWhere('ownership', 'Non-Profit')
                ->select('ownership', DB::raw('count(*) as total'))
                ->groupBy('ownership')
                ->get();

    	$labels = [];
    	$counts = [];

    	foreach ($type_counts as $type) {
    		array_push($labels, $type->ownership);
    		array_push($counts, $type->total);
    	}

    	// Chart Array
        $chart = array(
            "chart" => array(
                "labels" => $labels,
            ),
            "datasets" => array(
                [
                    "name" => "Organization Type",
                    "values" => $counts
                ],
            )
        );

        // Convert to json
        $chart_json = json_encode($chart);

        // Return $chart_json
        return $chart_json;

    }

    // Top 10 Locations Chart
    /* Not currently in use because Cody wants a list instead */
    public function topLocations() {

        // Get Number of People by Locations
        $location_people = DB::table('location_person')
            ->select('location_id', DB::raw('count(*) as total'))
            ->groupBy('location_id')
            ->get()
            ->toArray();

        // Sort by Top Locations
        usort($location_people, function($a, $b) {
            return $b->total <=> $a->total;
        });

        $labels = [];
        $counts = [];

        $count = 0;

        // Loop through $location_people
        foreach ($location_people as $item) {

            $count++;

            // Stop after 10
            if ($count >= 11) {
                break;
            }

            // Get Location City
            $location = Location::find($item->location_id);

            // Get City or Whole Name
            if ($location->city == '') {
                $label = $location->name;
            } else {
                $label = $location->city;
            }

            array_push($labels, $label);
            array_push($counts, $item->total);
        }

        // Chart Array
        $chart = array(
            "chart" => array(
                "labels" => $labels,
            ),
            "datasets" => array(
                [
                    "name" => "Location",
                    "values" => $counts
                ],
            )
        );

        // Convert to json
        $chart_json = json_encode($chart);

        // Return $chart_json
        return $chart_json;

    }
}
