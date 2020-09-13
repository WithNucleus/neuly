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
    protected $description = 'Update Phase Integer Field Value from Phases Field';

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
        $clinicaltrials = Clinicaltrial::whereNull('phase_integer')
            ->take(100)
            ->get();

        foreach ($clinicaltrials as $clinicaltrial) {

            $this->info($clinicaltrial->title);

            switch ($clinicaltrial->phases) {
                case "Early Phase 1":
                    $clinicaltrial->phase_integer = 1;
                    break;
                case "Phase 1":
                    $clinicaltrial->phase_integer = 2;
                    break;
                case "Phase 2":
                case "Phase 1|Phase 2":
                    $clinicaltrial->phase_integer = 3;
                    break;
                case "Phase 2|Phase 3":
                case "Phase 3":
                    $clinicaltrial->phase_integer = 4;
                    break;
                case "Phase 4":
                    $clinicaltrial->phase_integer = 5;
                    break;
                default:
                    $clinicaltrial->phase_integer = 0;
            }

            $clinicaltrial->save();
        }
    }
}
