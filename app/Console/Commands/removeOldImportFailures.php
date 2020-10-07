<?php

namespace App\Console\Commands;

use App\GarbageCollection\ImportCleaner\FailureCleaner;
use Illuminate\Console\Command;

class removeOldImportFailures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:failures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean old import failures.';

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
        $cleaner = new FailureCleaner();
        dd($cleaner->cleanOldFailures());
    }
}
