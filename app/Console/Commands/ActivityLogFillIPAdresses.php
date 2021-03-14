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
        $fixedRows = 0;
        $activities = Activity::whereNull('ip')->limit(5000)->get();

        foreach ($activities as $activity) {
            if ($activity->properties->contains('ip')) {
                $activity->ip = $activity->properties['ip'];
            } else {
                $activity->ip = 'unknown';
            }

            $activity->save();
        }

        $this->info('IPs of '.$activities->count().' where filled successfully');

        if (Activity::whereNull('ip')->count() > 0) {
            $this->info('Starting filling IPs on next chunk of activities');
            $this->handle();
        }

        return 0;
    }
}
