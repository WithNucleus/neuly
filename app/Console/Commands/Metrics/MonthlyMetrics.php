<?php

namespace App\Console\Commands\Metrics;

use App\Jobs\Metrics\MetricsChange;
use App\Models\Metric;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MonthlyMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metrics:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches job for the monthly metrics change & sends a Slack notification';

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
     */
    public function handle(): int
    {
        $metric = Metric::where('date', Carbon::now()->format('Y-m-d'))->firstOrFail();
        MetricsChange::dispatch($metric, Metric::TYPE_CHANGE, Metric::FREQUENCY_MONTHLY);

        return 0;
    }
}
