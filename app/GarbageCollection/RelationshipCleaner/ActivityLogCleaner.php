<?php

namespace App\GarbageCollection\RelationshipCleaner;

use Illuminate\Support\Facades\DB;

class ActivityLogCleaner
{
    private $retentionDays = 90;

    public function __construct()
    {
        $this->retentionDays = env('ACTIVITY_LOG_RETENTION_DAYS', config('activitylog.delete_records_older_than_days', 90));
    }

    public function cleanActivityLogRelation()
    {
        $messages = [];
        $messages[] = $this->cleanOldActivityLogs();
        $messages[] = $this->cleanOrphanedActivityLogs();

        return $messages;
    }

    public function cleanOldActivityLogs()
    {
        $cutoffDate = now()->subDays($this->retentionDays);

        $count = DB::table('activity_log')
            ->where('created_at', '<', $cutoffDate)
            ->count();

        DB::table('activity_log')
            ->where('created_at', '<', $cutoffDate)
            ->delete();

        return 'Cleaned '.$count.' old Activity Log entries older than '.$this->retentionDays.' days.';
    }

    public function cleanOrphanedActivityLogs()
    {
        $totalOrphaned = 0;

        // Clean activity logs where the subject is a User that no longer exists
        $orphanedUsers = DB::table('activity_log')
            ->select('activity_log.id')
            ->where('activity_log.subject_type', '=', 'App\\User')
            ->leftJoin('users', 'activity_log.subject_id', '=', 'users.id')
            ->whereNull('users.id')
            ->pluck('id');

        $count = $orphanedUsers->count();
        if ($count > 0) {
            DB::table('activity_log')->whereIn('id', $orphanedUsers)->delete();
            $totalOrphaned += $count;
        }

        // Clean activity logs where the causer is a User that no longer exists
        $orphanedCausers = DB::table('activity_log')
            ->select('activity_log.id')
            ->where('activity_log.causer_type', '=', 'App\\User')
            ->leftJoin('users', 'activity_log.causer_id', '=', 'users.id')
            ->whereNull('users.id')
            ->pluck('id');

        $count = $orphanedCausers->count();
        if ($count > 0) {
            DB::table('activity_log')->whereIn('id', $orphanedCausers)->delete();
            $totalOrphaned += $count;
        }

        return 'Cleaned '.$totalOrphaned.' orphaned Activity Log entries.';
    }
}
