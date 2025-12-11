<?php

namespace App\GarbageCollection\RelationshipCleaner;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SessionCleaner
{
    public function cleanSessionRelation()
    {
        $messages = [];

        // Only clean if using database session driver
        if (config('session.driver') === 'database' && Schema::hasTable('sessions')) {
            $messages[] = $this->cleanExpiredSessions();
        } else {
            $messages[] = 'Session cleaning skipped (not using database driver or sessions table does not exist).';
        }

        return $messages;
    }

    public function cleanExpiredSessions()
    {
        $lifetime = config('session.lifetime', 120); // minutes
        $cutoffTime = now()->subMinutes($lifetime)->timestamp;

        $count = DB::table('sessions')
            ->where('last_activity', '<', $cutoffTime)
            ->count();

        DB::table('sessions')
            ->where('last_activity', '<', $cutoffTime)
            ->delete();

        return 'Cleaned '.$count.' expired Sessions.';
    }
}
