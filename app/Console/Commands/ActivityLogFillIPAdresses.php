<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;

class ActivityLogFillIPAdresses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activitylog:fillip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills IP adresses of entries where the extra field is null';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $activities = Activity::where('log_name', 'pageview')->whereNull('ip')->limit(5000)->get();

        foreach ($activities as $activity) {
            if ($activity->properties->has('ip')) {
                $activity->ip = $activity->properties['ip'];
            } else {
                $activity->ip = 'unknown';
            }

            $activity->save();
        }

        $this->info($activities->count().' IPs were processed');

        $left_to_process = Activity::where('log_name', 'pageview')->whereNull('ip')->count();

        if ($left_to_process > 0) {
            $this->info('There are '.$left_to_process.' activity records left to parse');
        }

        return 0;
    }
}
