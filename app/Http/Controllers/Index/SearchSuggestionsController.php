<?php

namespace App\Http\Controllers\Index;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Models\ClinicalTrialDetails\CtCondition;
use App\Models\ClinicalTrialDetails\CtIntervention;
use App\Models\ClinicalTrialDetails\CtOutcomeMeasure;
use App\Models\ClinicalTrialDetails\CtStudyDesign;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Location;
use App\Models\Person;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SearchSuggestionsController extends Controller
{
    /*
     * @param $relationship_table
     * @param $model_id_field
     * @param $model
     */
    public static function getPivotRelationships($relationship_table, $model_id_field, $model)
    {
        $model_ids = DB::table($relationship_table)->pluck($model_id_field)->unique();
        $model_records = $model::findMany($model_ids)->sortBy('name')->pluck('slug', 'name');

        $results = [];

        foreach ($model_records as $key => $value) {
            $this_result = [
                'name' => $key,
                'slug' => $value,
            ];

            array_push($results, $this_result);
        }

        return json_encode($results);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function everything()
    {
        $companies = Company::public()->pluck('slug', 'name')->toArray();
        $people = Person::public()->pluck('slug', 'name')->toArray();
        $locations = Location::all()->pluck('slug', 'name')->toArray();
        $clinicalTrials = Clinicaltrial::all()->pluck('slug', 'title')->toArray();
        $focuses = Focus::all();
        $investors = Investor::all()->pluck('slug', 'name')->toArray();
        $focusesWithAliases = [];

        foreach ($focuses as $focus) {
            $focusesWithAliases[$focus->name] = $focus->slug;
            $aliases = StringHelper::explodeAndFilterEmpty($focus->aliases, ';');

            foreach ($aliases as $alias) {
                $focusesWithAliases[$alias] = $focus->slug;
            }
        }

        $everything = array_merge($companies, $people, $locations, $clinicalTrials, $focusesWithAliases, $investors);
        $results = [];

        foreach ($everything as $name => $slug) {
            $results[] = [
                'name' => $name,
                'slug' => $slug,
            ];
        }

        return response()->json($results);
    }

    /* Get Authors (People) of Research Items */
    public function researchAuthors()
    {
        $researchAuthors = self::getPivotRelationships('person_research', 'person_id', \App\Models\Person::class);

        return $researchAuthors;
    }

    /* Get People Related to Investors */
    public function investorsPeople()
    {
        $investorsPeople = self::getPivotRelationships('investor_person', 'person_id', \App\Models\Person::class);

        return $investorsPeople;
    }

    /* Get Organizations of Investors */
    public function investorsOrganizations()
    {
        $investorsOrganizations = self::getPivotRelationships('company_investor', 'company_id', \App\Models\Company::class);

        return $investorsOrganizations;
    }

    /* Get Organizations of Focus Categories */
    public function focusOrganizations()
    {
        $focusOrganizations = self::getPivotRelationships('company_focus', 'company_id', \App\Models\Company::class);

        return $focusOrganizations;
    }

    /* Get Organizations of Clinical Trials */
    public function clinicalTrialCollaborators()
    {
        $collaborators = self::getPivotRelationships('clinicaltrial_company', 'company_id', \App\Models\Company::class);

        return $collaborators;
    }

    public function clinicalTrialResearchers()
    {
        return self::getPivotRelationships('clinicaltrial_person', 'person_id', \App\Models\Person::class);
    }

    public function peopleOrganizations()
    {
        return self::getPivotRelationships('company_person', 'company_id', Company::class);
    }

    public function clinicalTrialConditions()
    {
        $data = CtCondition::whereHas('clinicalTrials')
            ->orderBy('value')
            ->pluck('value')
            ->map(function ($item) {
                return ['name' => $item];
            });

        return response()->json($data, Response::HTTP_OK);
    }

    public function clinicalTrialInterventions()
    {
        $data = CtIntervention::whereHas('clinicalTrials')
            ->orderBy('value')
            ->pluck('value')
            ->map(function ($item) {
                return ['name' => $item];
            });

        return response()->json($data, Response::HTTP_OK);
    }

    public function clinicalTrialOutcomeMeasures()
    {
        $data = CtOutcomeMeasure::whereHas('clinicalTrials')
            ->orderBy('value')
            ->pluck('value')
            ->map(function ($item) {
                return ['name' => $item];
            });

        return response()->json($data, Response::HTTP_OK);
    }

    public function clinicalTrialStudyDesigns()
    {
        $data = CtStudyDesign::whereHas('clinicalTrials')
            ->orderBy('value')
            ->pluck('value')
            ->map(function ($item) {
                return ['name' => $item];
            });

        return response()->json($data, Response::HTTP_OK);
    }

    /* Get All Regions */
    public function locationsRegions()
    {
        $locations_with_regions = Location::where('region', '!=', '')->get()->pluck('region')->unique()->sort();

        $locations_with_cities = Location::where('city', '!=', '')->get()->pluck('city')->unique()->sort();

        $locations = [];

        foreach ($locations_with_cities as $key => $value) {
            $this_result = [
                'name' => $value,
            ];
            array_push($locations, $this_result);
        }

        foreach ($locations_with_regions as $key => $value) {
            $this_result = [
                'name' => $value,
            ];
            array_push($locations, $this_result);
        }

        return json_encode($locations);
    }

    public function companiesLocations()
    {
        return $this->getRelatedLocations('company_location');
    }

    public function peopleLocations()
    {
        return $this->getRelatedLocations('location_person');
    }

    public function investorsLocations()
    {
        return $this->getRelatedLocations('investor_location');
    }

    /**
     * @return false|string
     */
    private function getRelatedLocations($pivotTable)
    {
        $ids = DB::table($pivotTable)->pluck('location_id')->unique();
        $location_models = Location::findMany($ids)->sortBy('name');

        $regions = [];
        $cities = [];
        $countries = [];

        foreach ($location_models as $location) {
            // Region
            if ($location->region != '') {
                array_push($regions, $location->region);
            }

            // City
            if ($location->city != '') {
                if ($location->region != '') {
                    array_push($cities, $location->city.', '.$location->region);
                } else {
                    array_push($cities, $location->city.', '.$location->country);
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

        $results = [];

        foreach ($locations as $key => $value) {
            $this_result = [
                'name' => $value,
            ];

            array_push($results, $this_result);
        }

        return json_encode($results);
    }
}
