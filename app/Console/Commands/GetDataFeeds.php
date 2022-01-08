<?php

namespace App\Console\Commands;

use App\Jobs\DataFeeds\GetRssFeed;
use App\Models\DataFeed;
use Illuminate\Console\Command;

class GetDataFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dataFeeds:getAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches a job to get all active feeds';

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
        $dataFeeds = DataFeed::where('status', DataFeed::STATUS_ACTIVE)->get();

        foreach ($dataFeeds as $dataFeed) {
            if ($dataFeed->feed_type == DataFeed::FEED_TYPE_RSS) {
                GetRssFeed::dispatch($dataFeed);
            }
        }

        return 0;
    }
}
