<?php

namespace App\Console\Commands;

use App\Jobs\Metrics\CollectMetrics;
use Illuminate\Console\Command;

class DailyMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyMetrics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts a collection of Neuly metrics (count of all entities)';

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
        CollectMetrics::dispatch('daily');
        return 0;
    }
}
