<?php

namespace App\Console\Commands\DataFeeds;

use App\Jobs\DataFeeds\GetRssFeed;
use App\Models\DataFeed;
use Illuminate\Console\Command;

class GetGoogleAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dataFeeds:googleAlerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches a job to get all Google Alerts';

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
        $dataFeeds = DataFeed::googleAlerts()->where('status', DataFeed::STATUS_ACTIVE)->get();

        foreach ($dataFeeds as $dataFeed) {
            GetRssFeed::dispatch($dataFeed);
        }

        return 0;
    }
}
