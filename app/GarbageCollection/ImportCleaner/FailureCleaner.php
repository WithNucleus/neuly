<?php

namespace App\GarbageCollection\ImportCleaner;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FailureCleaner
{
    private $lifetime = 60;

    public function __construct() {
        $lifetime = 60;
    }

    public function cleanOldFailures()
    {
        $oldFailures = DB::table('import_failures')
            ->select('id')
            ->where('created_at', '>=', Carbon::now()->subDays($this->lifetime))
            ->get()->pluck('id');

        DB::table('import_failures')->whereIn('id', $oldFailures)->delete();

        return "Cleaned ".$oldFailures->count()." Import Failures older then ".$this->lifetime." days.";
    }
}
