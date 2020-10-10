<?php

namespace App\Console\Commands;

use App\GarbageCollection\RelationshipCleaner;
use Illuminate\Console\Command;

class removeOrphenedRelations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:relations';

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
        $collector = new RelationshipCleaner();
        $messages = $collector->cleanRelations();

        foreach($messages as $message)
        {
            $this->info($message);
        }
    }
}
