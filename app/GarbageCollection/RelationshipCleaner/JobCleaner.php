<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Job;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class JobCleaner
{
    private $jobs = null;

    private $locations = null;

    public function __construct()
    {
        $this->jobs = Job::all()->pluck('id');
        $this->locations = Location::all()->pluck('id');
    }

    public function cleanJobRelation()
    {
        $messages = [];

        $messages[] = $this->cleanLocationRelation();
        $messages[] = $this->cleanJobApplicationRelation();

        return $messages;
    }

    public function cleanLocationRelation()
    {
        $orphened = DB::table('job_location')
            ->select('job_id', 'location_id')
            ->whereNotIn('location_id', $this->locations)
            ->orWhereNotIn('job_id', $this->jobs)
            ->get();

        foreach ($orphened as $entry) {
            DB::table('job_location')
                ->where('location_id', '=', $entry->location_id)
                ->where('job_id', '=', $entry->job_id)
                ->delete();
        }

        return 'Cleaned '.$orphened->count().' orphened Relationships between Jobs and Locations.';
    }

    public function cleanJobApplicationRelation()
    {
        $orphened = DB::table('job_applications')
            ->select('id')
            ->whereNotIn('job_id', $this->jobs)
            ->get()->pluck('id');

        DB::table('job_applications')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Jobs and Job Applications.';
    }
}
