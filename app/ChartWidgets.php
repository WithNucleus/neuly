<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Location;

class ChartWidgets extends Model
{
    // Company Type Chart
    public static function companyTypeChart() {

    	$type_collection = DB::table('companies')
                ->where('ownership', 'Privately Held')
                ->orWhere('ownership', 'Public Company')
                ->orWhere('ownership', 'Non-Profit')
                ->select('ownership', DB::raw('count(*) as total'))
                ->groupBy('ownership')
                ->get();

        $type_counts = [];
        $labels = "";

        foreach ($type_collection as $type) {
            array_push($type_counts, $type->total);
            $labels .= "'" . $type->ownership . "', ";
        }

        $counts = implode(', ', $type_counts);

        $labels = rtrim($labels, ", ");

        $response = array(
        	'labels' => $labels,
        	'counts' => $counts
        );

        return $response;
    }

    // Top 10 Locations by People
    public static function topTenLocations() {

    	$location_people = DB::table('location_person')
            ->select('location_id', DB::raw('count(*) as total'))
            ->groupBy('location_id')
            ->get()
            ->toArray();

        // Sort by Top Locations
        usort($location_people, function($a, $b) {
            return $b->total <=> $a->total;
        });

        $location_counts = [];
        $location_labels = "";

        $count = 0;

        $top_ten_locations = array();

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

            $slug = $location->slug;

            $this_location = array(
                'name' => $label,
                'count' => $item->total,
                'slug' => $slug
            );

            array_push($top_ten_locations, $this_location);
        }

        return $top_ten_locations;
    }
}
