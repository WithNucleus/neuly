<?php

namespace App\Console\Commands;

use App\Models\Clinicaltrial;
use App\Models\ClinicaltrialPhase;
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
    protected $description = 'Update Phase Integer Field Value from Phases Field based on Clinical Trial Phases model records';

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
        $phases = ClinicaltrialPhase::all()->pluck('integer', 'name')->toArray();

        $clinicaltrials = Clinicaltrial::whereNull('phase_integer')
            ->take(100)
            ->get();

        foreach ($clinicaltrials as $clinicaltrial) {
            if (array_key_exists($clinicaltrial->phases, $phases)) {
                $phase_name = $clinicaltrial->phases;
                $integer = $phases[$phase_name];
            } else {
                $integer = 0;
            }

            $clinicaltrial->phase_integer = $integer;
            $clinicaltrial->save();
            $this->info($clinicaltrial->title);
        }
    }
}
