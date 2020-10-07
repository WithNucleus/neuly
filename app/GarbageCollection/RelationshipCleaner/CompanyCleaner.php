<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Location;
use App\Models\Person;
use App\Models\Research;
use Illuminate\Support\Facades\DB;

class CompanyCleaner
{
    private $companies = null;
    private $events = null;
    private $focus = null;
    private $investors = null;
    private $locations = null;
    private $people = null;
    private $research = null;

    public function __construct()
    {
        $this->companies = Company::all()->pluck('id');
        $this->events = Event::all()->pluck('id');
        $this->focus = Focus::all()->pluck('id');
        $this->investors = Investor::all()->pluck('id');
        $this->locations = Location::all()->pluck('id');
        $this->people = Person::all()->pluck('id');
        $this->research = Research::all()->pluck('id');
    }

    public function cleanCompanyRelation()
    {
        $messages = [];
        $messages[] = $this->cleanEventRelation();
        $messages[] = $this->cleanFocusRelation();
        $messages[] = $this->cleanInvestorRelation();
        $messages[] = $this->cleanLocationRelation();
        $messages[] = $this->cleanPersonRelation();
        $messages[] = $this->cleanResearchRelation();
        $messages[] = $this->cleanJobApplicationRelation();

        return $messages;
    }

    public function cleanEventRelation()
    {
        $orphened = DB::table('company_event')
            ->select('company_id', 'event_id')
            ->whereNotIn('event_id', $this->events)
            ->orWhereNotIn('company_id', $this->companies)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('company_event')
                ->where('event_id','=', $entry->event_id)
                ->where('company_id','=', $entry->company_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Companies and Events.";
    }

    public function cleanFocusRelation()
    {
        $orphened = DB::table('company_focus')
            ->select('company_id', 'focus_id')
            ->whereNotIn('focus_id', $this->focus)
            ->orWhereNotIn('company_id', $this->companies)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('company_focus')
                ->where('focus_id','=', $entry->focus_id)
                ->where('company_id','=', $entry->company_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Companies and Focus.";
    }

    public function cleanInvestorRelation()
    {
        $orphened = DB::table('company_investor')
            ->select('id')
            ->whereNotIn('investor_id', $this->investors)
            ->orWhereNotIn('company_id', $this->companies)
            ->get()->pluck('id');

        DB::table('company_investor')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Companies and Investors.";
    }

    public function cleanLocationRelation()
    {
        $orphened = DB::table('company_location')
            ->select('id')
            ->whereNotIn('location_id', $this->locations)
            ->orWhereNotIn('company_id', $this->companies)
            ->get()->pluck('id');

        DB::table('company_location')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Companies and Locations.";
    }

    public function cleanPersonRelation()
    {
        $orphened = DB::table('company_person')
            ->select('company_id', 'person_id')
            ->whereNotIn('person_id', $this->people)
            ->orWhereNotIn('company_id', $this->companies)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('company_person')
                ->where('person_id','=', $entry->person_id)
                ->where('company_id','=', $entry->company_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Companies and People.";
    }

    public function cleanResearchRelation()
    {
        $orphened = DB::table('company_research')
            ->select('company_id', 'research_id')
            ->whereNotIn('research_id', $this->research)
            ->orWhereNotIn('company_id', $this->companies)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('company_research')
                ->where('research_id','=', $entry->research_id)
                ->where('company_id','=', $entry->company_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Companies and People.";
    }

    public function cleanJobApplicationRelation()
    {
        $orphened = DB::table('job_applications')
            ->select('id')
            ->whereNotIn('company_id', $this->companies)
            ->get()->pluck('id');

        DB::table('job_applications')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Companies and Job Applications.";
    }
}
