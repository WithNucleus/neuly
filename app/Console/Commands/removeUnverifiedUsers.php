<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class removeUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:unverified';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans unverified users older than 42 hours';

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
        User::whereNull('email_verified_at')
            ->where('created_at', '<', Carbon::parse('-48 hours'))
            ->where('created_at', '>', Carbon::parse('2020-10-28'))
            ->delete();

        $this->info('Unverified users older then 48 hours got deleted');
    }
}
