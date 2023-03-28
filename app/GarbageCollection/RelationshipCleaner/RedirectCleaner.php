<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class RedirectCleaner
{
    private $trials = null;

    private $companies = null;

    private $events = null;

    private $focus = null;

    private $investors = null;

    private $jobs = null;

    private $locations = null;

    private $people = null;

    public function __construct()
    {
        $this->trials = Clinicaltrial::all()->pluck('id');
        $this->companies = Company::all()->pluck('id');
        $this->events = Event::all()->pluck('id');
        $this->focus = Focus::all()->pluck('id');
        $this->investors = Investor::all()->pluck('id');
        $this->jobs = Job::all()->pluck('id');
        $this->locations = Location::all()->pluck('id');
        $this->people = Person::all()->pluck('id');
    }

    public function cleanRedirectRelation()
    {
        $messages = [];

        $messages[] = $this->cleanClinicaltrialRelation();
        $messages[] = $this->cleanCompanyRelation();
        $messages[] = $this->cleanEventRelation();
        $messages[] = $this->cleanFocusRelation();
        $messages[] = $this->cleanInvestorRelation();
        $messages[] = $this->cleanJobRelation();
        $messages[] = $this->cleanLocationRelation();
        $messages[] = $this->cleanPersonRelation();

        return $messages;
    }

    public function cleanClinicaltrialRelation()
    {
        $orphened = DB::table('redirects')
            ->select('id')
            ->where('redirectable_type', '=', Clinicaltrial::class)
            ->whereNotIn('redirectable_id', $this->trials)
            ->get()->pluck('id');

        DB::table('redirects')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Redirects and Clinical Trials.';
    }

    public function cleanCompanyRelation()
    {
        $orphened = DB::table('redirects')
            ->select('id')
            ->where('redirectable_type', '=', Company::class)
            ->whereNotIn('redirectable_id', $this->companies)
            ->get()->pluck('id');

        DB::table('redirects')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Redirects and Companies.';
    }

    public function cleanEventRelation()
    {
        $orphened = DB::table('redirects')
            ->select('id')
            ->where('redirectable_type', '=', Event::class)
            ->whereNotIn('redirectable_id', $this->events)
            ->get()->pluck('id');

        DB::table('redirects')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Redirects and Events.';
    }

    public function cleanFocusRelation()
    {
        $orphened = DB::table('redirects')
            ->select('id')
            ->where('redirectable_type', '=', Focus::class)
            ->whereNotIn('redirectable_id', $this->focus)
            ->get()->pluck('id');

        DB::table('redirects')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Redirects and Focus.';
    }

    public function cleanInvestorRelation()
    {
        $orphened = DB::table('redirects')
            ->select('id')
            ->where('redirectable_type', '=', Investor::class)
            ->whereNotIn('redirectable_id', $this->investors)
            ->get()->pluck('id');

        DB::table('redirects')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Redirects and Investors.';
    }

    public function cleanJobRelation()
    {
        $orphened = DB::table('redirects')
            ->select('id')
            ->where('redirectable_type', '=', Job::class)
            ->whereNotIn('redirectable_id', $this->jobs)
            ->get()->pluck('id');

        DB::table('redirects')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Redirects and Jobs.';
    }

    public function cleanLocationRelation()
    {
        $orphened = DB::table('redirects')
            ->select('id')
            ->where('redirectable_type', '=', Location::class)
            ->whereNotIn('redirectable_id', $this->locations)
            ->get()->pluck('id');

        DB::table('redirects')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Redirects and Locations.';
    }

    public function cleanPersonRelation()
    {
        $orphened = DB::table('redirects')
            ->select('id')
            ->where('redirectable_type', '=', Person::class)
            ->whereNotIn('redirectable_id', $this->people)
            ->get()->pluck('id');

        DB::table('redirects')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Redirects and People.';
    }
}
