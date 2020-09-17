<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Person;
use App\Models\Location;
use App\Models\Focus;
use DB;

class SearchSuggestionsController extends Controller
{

    /*
     * @param $relationship_table
     * @param $model_id_field
     * @param $model
     */
    public static function getPivotRelationships($relationship_table, $model_id_field, $model) {

        $model_ids = DB::table($relationship_table)->pluck($model_id_field)->unique();
        $model_records = $model::findMany($model_ids)->sortBy('name')->pluck('slug', 'name');

        $results = array();

        foreach($model_records as $key => $value) {
            $this_result = array(
                'name' => $key,
                'slug' => $value
            );

            array_push($results, $this_result);
        }

        return json_encode($results);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function everything() {

        $companies      = Company::all()->pluck('slug', 'name')->toArray();
        $people         = Person::all()->pluck('slug', 'name')->toArray();
        $locations      = Location::all()->pluck('slug', 'name')->toArray();
        $focus          = Focus::all()->pluck('slug', 'name')->toArray();
        $clinicalTrials = Clinicaltrial::all()->pluck('slug', 'title')->toArray();

        $everything = array_merge($companies, $people, $locations, $focus, $clinicalTrials);
        $results    = [];

        foreach ($everything as $name => $slug) {
            $results[] = [
                'name' => $name,
                'slug' => $slug
            ];
        }

        return response()->json($results);
    }

    /* Get Authors (People) of Research Items */
    public function researchAuthors() {
        $researchAuthors = self::getPivotRelationships('person_research', 'person_id', 'App\Models\Person');
        return $researchAuthors;
    }

    /* Get People Related to Investors */
    public function investorsPeople() {
        $investorsPeople = self::getPivotRelationships('investor_person', 'person_id', 'App\Models\Person');
        return $investorsPeople;
    }

    /* Get Organizations of Investors */
    public function investorsOrganizations() {
        $investorsOrganizations = self::getPivotRelationships('company_investor', 'company_id', 'App\Models\Company');
        return $investorsOrganizations;
    }

    /* Get Organizations of Focus Categories */
    public function focusOrganizations() {
        $focusOrganizations = self::getPivotRelationships('company_focus', 'company_id', 'App\Models\Company');
        return $focusOrganizations;
    }

    /* Get Organizations of Clinical Trials */
    public function clinicalTrialCollaborators() {
        $collaborators = self::getPivotRelationships('clinicaltrial_company', 'company_id', 'App\Models\Company');
        return $collaborators;
    }

    /* Get All Regions */
    public function locationsRegions() {

        $locations_with_regions = Location::where('region', '!=', '')->get()->pluck('region')->unique()->sort();

        $locations_with_cities = Location::where('city', '!=', '')->get()->pluck('city')->unique()->sort();

        $locations = array();

        foreach ($locations_with_cities as $key => $value) {
            $this_result = array(
                'name' => $value
            );
            array_push($locations, $this_result);
        }

        foreach ($locations_with_regions as $key => $value) {
            $this_result = array(
                'name' => $value
            );
            array_push($locations, $this_result);
        }

        return json_encode($locations);
    }

    /* Get Locations of Organizations */
    public function companiesLocations() {

        $ids = DB::table('company_location')->pluck('company_id')->unique();
        $location_models = Location::findMany($ids)->sortBy('name');

        $regions = array();
        $cities = array();
        $countries = array();

        foreach ($location_models as $location) {

            // Region
            if ($location->region != '') {
                array_push($regions, $location->region);
            }

            // City
            if ($location->city != '') {

                if ($location->region != '') {

                    array_push($cities, $location->city . ', ' . $location->region);

                } else {

                    array_push($cities, $location->city . ', ' . $location->country);

                }
            }

            // Country
            if ($location->country != '') {
                array_push($countries, $location->country);
            }

        }

        $regions_clean = array_unique($regions);
        $cities_clean = array_unique($cities);
        $countries_clean = array_unique($countries);


        $locations_all = array_merge($regions_clean, $cities_clean, $countries_clean);
        $locations = array_unique($locations_all);

        $results = array();

        foreach($locations as $key => $value) {

            $this_result = array(
                'name' => $value
            );

            array_push($results, $this_result);
        }

        return json_encode($results);

    }
}
