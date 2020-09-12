<?php

namespace App\Console\Commands;

use App\Models\Clinicaltrial;
use Illuminate\Console\Command;

class updateClinicalTrialPhases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateClinicalTrialPhases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change Early Phase 1 to Phase 0';

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
     * @return mixed
     */
    public function handle()
    {
        $clinicaltrials = Clinicaltrial::where('phases', 'Early Phase 1')
            ->take(10)
            ->get();

        foreach ($clinicaltrials as $clinicaltrial) {
            $this->info($clinicaltrial->title);
            $clinicaltrial->phases = 'Phase 0';
            $clinicaltrial->save();
        }
    }
}
