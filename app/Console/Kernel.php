<?php

namespace App\Console;

use App\Jobs\EmailMarketing\PrepEmails;
use App\Jobs\EmailMarketing\SendEmails;
use App\Jobs\SendEmailNotifications;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Spatie\SlackAlerts\Facades\SlackAlert;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Backups
        $schedule
            ->command('backup:run')
            ->twiceDaily(9, 17)
            ->onFailure(function () {
                Log::critical('Backup Failed!');
            });

        $schedule
            ->command('backup:run --only-db --filename=db_'.date('Y-m-d_H-i-s').'.zip')
            ->everyThirtyMinutes()
            ->onFailure(function () {
                Log::critical('Backup Failed!');
            });

        // Send E-Mail Notifications
        $schedule
            ->job(new SendEmailNotifications())
            ->weeklyOn(3, '12:00');

        // Remove Unverified Users
        $schedule
            ->command('clean:unverified')
            ->dailyAt(1)
            ->onFailure(function () {
                Log::critical('Cleaning unverified users Failed!');
            })
            ->onSuccess(function () {
                Log::info('Cleaning unverified users Succeeded!');
            });

        // Data Feeds - Google Alerts
        $schedule
            ->command('dataFeeds:googleAlerts')
            ->hourlyAt(15)
            ->onFailure(function () {
                Log::critical('Data Feeds - Google Alerts failed');
            })
            ->onSuccess(function () {
                Log::info('Data Feeds - Google Alerts successful');
            });

        // Data Feeds - All
        $schedule
            ->command('dataFeeds:getAll')
            ->everySixHours()
            ->onFailure(function () {
                Log::critical('Data Feeds - Google Alerts failed');
            })
            ->onSuccess(function () {
                Log::info('Data Feeds - Google Alerts successful');
            });

        // Clean Backups
        $schedule
            ->command('backup:clean')
            ->weeklyOn(1, '8:30')
            ->onFailure(function () {
                Log::critical('Clean backups failed');
            });

        // Metrics
        $schedule
            ->command('metrics:daily')
            ->daily()
            ->onFailure(function () {
                Log::critical('Daily metrics failed');
            });

        $schedule
            ->command('metrics:weekly')
            ->weeklyOn(1, '0:05')
            ->onFailure(function () {
                Log::critical('Weekly metrics failed');
            });

        $schedule
            ->command('metrics:monthly')
            ->monthlyOn(1, '0:05')
            ->onFailure(function () {
                Log::critical('Monthly metrics failed');
            });

        $schedule
            ->command('metrics:yearly')
            ->yearlyOn(1, 1, '0:05')
            ->onFailure(function () {
                Log::critical('Yearly metrics failed');
            });

        $schedule
            ->command('activitylog:archive')
            ->monthlyOn(1)
            ->onFailure(function () {
                Log::critical('Activity log archive command failed');
            });

        //Run after 'activitylog:archive' command at same day
        $schedule
            ->command('activitylog:clean')
            ->monthlyOn(1, '23:00')
            ->onFailure(function() {
                Log::critical('Activity log clean command failed');
            });

        // Email Marketing
        $schedule
            ->job(new PrepEmails())
            ->everyMinute()
            ->onFailure(function() {
                SlackAlert::to('dev')->message('<@sydney> Failure during PrepEmails scheduled task');
            });

        $schedule
            ->job(new SendEmails())
            ->everyMinute()
            ->onFailure(function() {
                SlackAlert::to('dev')->message('<@sydney> Failure during SendEmails scheduled task');
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
