<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Company;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class NotificationCleaner
{
    private $companies = null;
    private $people = null;
    private $focus = null;
    private $investors = null;
    private $locations = null;
    private $jobs = null;

    public function __construct()
    {
        $this->companies = Company::all()->pluck('id');
        $this->people = Person::all()->pluck('id');
        $this->focus = Focus::all()->pluck('id');
        $this->investors = Investor::all()->pluck('id');
        $this->locations = Location::all()->pluck('id');
        $this->jobs = Job::all()->pluck('id');
    }

    public function cleanNotificationRelation()
    {
        $messages = [];

        $messages[] = $this->cleanCompanyRelation();
        $messages[] = $this->cleanPersonRelation();
        $messages[] = $this->cleanFocusRelation();
        $messages[] = $this->cleanInvestorRelation();
        $messages[] = $this->cleanLocationRelation();
        $messages[] = $this->cleanJobRelation();

        return $messages;
    }

    public function cleanCompanyRelation()
    {
        $orphened = DB::table('notifications')
            ->select('id')
            ->where('notifier_type', Company::class)
            ->whereNotIn('notifier_id', $this->companies)
            ->get()->pluck('id');

        DB::table('notifications')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Notifications and Companies.";
    }

    public function cleanPersonRelation()
    {
        $orphened = DB::table('notifications')
            ->select('id')
            ->where('notifier_type', Person::class)
            ->whereNotIn('notifier_id', $this->people)
            ->get()->pluck('id');

        DB::table('notifications')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Notifications and People.";
    }

    public function cleanFocusRelation()
    {
        $orphened = DB::table('notifications')
            ->select('id')
            ->where('notifier_type', Focus::class)
            ->whereNotIn('notifier_id', $this->focus)
            ->get()->pluck('id');

        DB::table('notifications')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Notifications and Focus.";
    }

    public function cleanInvestorRelation()
    {
        $orphened = DB::table('notifications')
            ->select('id')
            ->where('notifier_type', Investor::class)
            ->whereNotIn('notifier_id', $this->investors)
            ->get()->pluck('id');

        DB::table('notifications')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Notifications and Investors.";
    }

    public function cleanLocationRelation()
    {
        $orphened = DB::table('notifications')
            ->select('id')
            ->where('notifier_type', Location::class)
            ->whereNotIn('notifier_id', $this->locations)
            ->get()->pluck('id');

        DB::table('notifications')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Notifications and Locations.";
    }

    public function cleanJobRelation()
    {
        $orphened = DB::table('notifications')
            ->select('id')
            ->where('notifier_type', Job::class)
            ->whereNotIn('notifier_id', $this->jobs)
            ->get()->pluck('id');

        DB::table('notifications')->whereIn('id', $orphened)->delete();

        return "Cleaned ".$orphened->count()." orphened Relationships between Notifications and Jobs.";
    }
}
