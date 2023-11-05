<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class removeUnverifiedUsers extends Command
{
    protected $signature = 'clean:unverified';

    protected $description = 'Cleans unverified users older than 1 week';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        User::whereNull('email_verified_at')
            ->where('created_at', '<', Carbon::parse('-1 week'))
            ->where('created_at', '>', Carbon::parse('2020-10-28'))
            ->delete();
    }
}
