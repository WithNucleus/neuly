<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Investor;
use App\Models\Location;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class InvestorCleaner
{
    private $investors = null;

    private $locations = null;

    private $people = null;

    public function __construct()
    {
        $this->investors = Investor::all()->pluck('id');
        $this->locations = Location::all()->pluck('id');
        $this->people = Person::all()->pluck('id');
    }

    public function cleanInvestorRelation()
    {
        $messages = [];

        $messages[] = $this->cleanLocationRelation();
        $messages[] = $this->cleanPersonRelation();

        return $messages;
    }

    public function cleanLocationRelation()
    {
        $orphened = DB::table('investor_location')
            ->select('id')
            ->whereNotIn('location_id', $this->locations)
            ->orWhereNotIn('investor_id', $this->investors)
            ->get()->pluck('id');

        DB::table('investor_location')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Investors and Locations.';
    }

    public function cleanPersonRelation()
    {
        $orphened = DB::table('investor_person')
            ->select('id')
            ->whereNotIn('person_id', $this->people)
            ->orWhereNotIn('investor_id', $this->investors)
            ->get()->pluck('id');

        DB::table('investor_person')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Investors and People.';
    }
}
