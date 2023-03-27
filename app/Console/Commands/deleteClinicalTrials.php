<?php

namespace App\Console\Commands;

use App\Models\Clinicaltrial;
use Illuminate\Console\Command;

class deleteClinicalTrials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteClinicalTrials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete clinical trials that have no focus assigned';

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
        $clinicaltrials = Clinicaltrial::doesntHave('focus')->get();

        foreach ($clinicaltrials as $clinicaltrial) {
            $this->info('Deleting '.$clinicaltrial->title);
            $clinicaltrial->delete();
        }
    }
}
