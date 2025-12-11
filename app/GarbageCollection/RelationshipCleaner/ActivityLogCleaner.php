<?php

namespace App\GarbageCollection\RelationshipCleaner;

use Illuminate\Support\Facades\DB;

class ActivityLogCleaner
{
    private $retentionDays = 90;

    public function __construct()
    {
        $this->retentionDays = config('activitylog.delete_records_older_than_days', 90);
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
        // Clean activity logs where the subject no longer exists
        $orphanedSubjects = DB::table('activity_log')
            ->whereNotNull('subject_type')
            ->whereNotNull('subject_id')
            ->get()
            ->filter(function ($log) {
                $model = $log->subject_type;
                if (!class_exists($model)) {
                    return true;
                }
                return !DB::table((new $model)->getTable())
                    ->where('id', $log->subject_id)
                    ->exists();
            })
            ->pluck('id');

        DB::table('activity_log')->whereIn('id', $orphanedSubjects)->delete();

        // Clean activity logs where the causer no longer exists
        $orphanedCausers = DB::table('activity_log')
            ->whereNotNull('causer_type')
            ->whereNotNull('causer_id')
            ->get()
            ->filter(function ($log) {
                $model = $log->causer_type;
                if (!class_exists($model)) {
                    return true;
                }
                return !DB::table((new $model)->getTable())
                    ->where('id', $log->causer_id)
                    ->exists();
            })
            ->pluck('id');

        DB::table('activity_log')->whereIn('id', $orphanedCausers)->delete();

        $totalOrphaned = $orphanedSubjects->count() + $orphanedCausers->count();

        return 'Cleaned '.$totalOrphaned.' orphaned Activity Log entries.';
    }
}
