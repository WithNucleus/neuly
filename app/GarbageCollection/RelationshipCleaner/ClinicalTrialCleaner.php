<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Location;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class ClinicalTrialCleaner
{
    private $trials = null;
    private $companies = null;
    private $focus = null;
    private $locations = null;
    private $people = null;

    public function __construct()
    {
        $this->trials = Clinicaltrial::all()->pluck('id');
        $this->companies = Company::all()->pluck('id');
        $this->focus = Focus::all()->pluck('id');
        $this->locations = Location::all()->pluck('id');
        $this->people = Person::all()->pluck('id');
    }

    public function cleanClinicalTrialRelationships()
    {
        $messages = [];

        $messages[] = $this->cleanCompanyRelation();
        $messages[] = $this->cleanFocusRelation();
        $messages[] = $this->cleanLocationRelation();
        $messages[]  = $this->cleanPersonRelation();

        return $messages;
    }

    public function cleanCompanyRelation()
    {
        $orphened = DB::table('clinicaltrial_company')
            ->select('id')
            ->whereNotIn('company_id', $this->companies)
            ->orWhereNotIn('clinicaltrial_id', $this->trials)
            ->get()->pluck('id');

        DB::table('clinicaltrial_company')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Clinicaltrials and Companies.";
    }

    public function cleanFocusRelation()
    {
        $orphened = DB::table('clinicaltrial_focus')
            ->select('clinicaltrial_id', 'focus_id')
            ->whereNotIn('focus_id', $this->focus)
            ->orWhereNotIn('clinicaltrial_id', $this->trials)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('clinicaltrial_focus')
                ->where('focus_id','=', $entry->focus_id)
                ->where('clinicaltrial_id','=', $entry->clinicaltrial_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Clinicaltrials and Focus.";
    }

    public function cleanLocationRelation()
    {
        $orphened = DB::table('clinicaltrial_location')
            ->select('clinicaltrial_id', 'location_id')
            ->whereNotIn('location_id', $this->locations)
            ->orWhereNotIn('clinicaltrial_id', $this->trials)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('clinicaltrial_location')
                ->where('location_id','=', $entry->location_id)
                ->where('clinicaltrial_id','=', $entry->clinicaltrial_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Clinicaltrials and Location.";
    }

    public function cleanPersonRelation()
    {
        $orphened = DB::table('clinicaltrial_person')
            ->select('id')
            ->whereNotIn('person_id', $this->companies)
            ->orWhereNotIn('clinicaltrial_id', $this->trials)
            ->get()->pluck('id');

        DB::table('clinicaltrial_person')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Clinicaltrials and People.";
    }
}
