<?php

namespace App\Console;

use App\Jobs\SendEmailNotifications;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // Schedule Backups
        $schedule
            ->command('backup:run')
            ->twiceDaily(9, 17)
            ->onFailure(function () {
                // Log Warning
                Log::critical('Backup Failed!');
            })
            ->onSuccess(function () {
                Log::info('Backup Succeeded!');
            });

        // DB backup every 30 minutes
        $schedule
            ->command('backup:run --only-db --filename=db_' . date('Y-m-d_H-i-s') . '.zip')
            ->everyThirtyMinutes()
            ->onFailure(function () {
                Log::critical('Backup Failed!');
            })
            ->onSuccess(function () {
                Log::info('Backup Succeeded!');
            });

        // Send E-Mail Notifications

        $schedule
            ->job(new SendEmailNotifications())
            ->weeklyOn(3, '12:00');

        // remove unverified users
        $schedule
            ->command('clean:unverified')
            ->dailyAt(1)
            ->onFailure(function() {
                Log::critical('Cleaning unverified users Failed!');
            })
            ->onSuccess(function() {
                Log::info('Cleaning unverified users Succeeded!');
            });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
