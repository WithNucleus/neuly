<?php

namespace App\Console\Commands;

use App\GarbageCollection\GarbageCollector;
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
        $collector = new GarbageCollector();
        $messages = $collector->collectGarbage();

        foreach ($messages as $message) {
            $this->info($message);
        }
    }
}
