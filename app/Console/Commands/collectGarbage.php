<?php

namespace App\Console\Commands;

use App\GarbageCollection\RelationshipCleaner;
use App\GarbageCollection\RelationshipCleaner\ClinicalTrialCleaner;
use App\GarbageCollection\RelationshipCleaner\CompanyCleaner;
use App\GarbageCollection\RelationshipCleaner\EventCleaner;
use App\GarbageCollection\RelationshipCleaner\FocusCleaner;
use App\GarbageCollection\RelationshipCleaner\InvestorCleaner;
use App\GarbageCollection\RelationshipCleaner\JobCleaner;
use App\GarbageCollection\RelationshipCleaner\LocationCleaner;
use App\GarbageCollection\RelationshipCleaner\PersonCleaner;
use App\GarbageCollection\RelationshipCleaner\UserCleaner;
use Illuminate\Console\Command;

class collectGarbage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'garbage:collect';

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
     * @return mixed
     */
    public function handle()
    {
        $cleaner = new RelationshipCleaner();
        dd($cleaner->cleanRelations());
    }
}
