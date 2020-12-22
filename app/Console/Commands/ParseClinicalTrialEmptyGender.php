<?php

namespace App\Console\Commands;

use App\Models\Clinicaltrial;
use Illuminate\Console\Command;

class ParseClinicalTrialEmptyGender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clinicaltrial:parsegender';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $trials = Clinicaltrial::where('gender', '=', '')->get();

        foreach($trials as $trial)
        {
            $trial->gender = null;
            $trial->save();
        }

        return 0;
    }
}
