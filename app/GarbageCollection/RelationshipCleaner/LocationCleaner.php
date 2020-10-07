<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Location;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class LocationCleaner
{
    private $locations = null;
    private $people = null;

    public function __construct()
    {
        $this->locations = Location::all()->pluck('id');
        $this->people = Person::all()->pluck('id');
    }

    public function cleanLocationRelation()
    {
        $messages = [];

        $messages[] = $this->cleanPersonRelation();

        return $messages;
    }

    public function cleanPersonRelation()
    {
        $orphened = DB::table('location_person')
            ->select('id')
            ->whereNotIn('person_id', $this->people)
            ->orWhereNotIn('location_id', $this->locations)
            ->get()->pluck('id');

        DB::table('location_person')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Locations and People.";
    }
}
