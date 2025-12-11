<?php

namespace App\GarbageCollection\RelationshipCleaner;

use Illuminate\Support\Facades\DB;

class FailedJobsCleaner
{
    private $retentionDays = 30;

    public function __construct()
    {
        $this->retentionDays = env('FAILED_JOBS_RETENTION_DAYS', 30);
    }

    public function cleanFailedJobsRelation()
    {
        $messages = [];
        $messages[] = $this->cleanOldFailedJobs();

        return $messages;
    }

    public function cleanOldFailedJobs()
    {
        $cutoffDate = now()->subDays($this->retentionDays);

        $count = DB::table('failed_jobs')
            ->where('failed_at', '<', $cutoffDate)
            ->count();

        DB::table('failed_jobs')
            ->where('failed_at', '<', $cutoffDate)
            ->delete();

        return 'Cleaned '.$count.' old Failed Jobs older than '.$this->retentionDays.' days.';
    }
}
