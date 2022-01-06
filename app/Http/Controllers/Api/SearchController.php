<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Location;
use App\Models\Person;

class SearchController extends Controller
{
    public function suggestions()
    {
        $companies = Company::all()->pluck('slug', 'name')->toArray();
        $people = Person::all()->pluck('slug', 'name')->toArray();
        $locations = Location::all()->pluck('slug', 'name')->toArray();
        $clinicalTrials = Clinicaltrial::all()->pluck('slug', 'title')->toArray();
        $investors = Investor::all()->pluck('slug', 'name')->toArray();
        $focuses = Focus::all();
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
                'slug' => $slug
            ];
        }

        return response()->json($results);
    }
}
