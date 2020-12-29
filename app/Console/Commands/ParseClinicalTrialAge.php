<?php

namespace App\Console\Commands;

use App\Helpers\ParsingAgeHelper;
use App\Models\Clinicaltrial;
use Illuminate\Console\Command;

class ParseClinicalTrialAge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clinicaltrial:parseAge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses age values for clinical trial records';

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
        $trials = Clinicaltrial::all();

        foreach($trials as $trial)
        {
            $ages = [];
            $matches = ParsingAgeHelper::getRelevantPassages($trial->age);

            foreach($matches as $match)
            {
                $ages[] = ParsingAgeHelper::getAgeValue($match);
            }

            ParsingAgeHelper::setAgeValues($trial, $ages);
        }

        return 0;
    }
}
