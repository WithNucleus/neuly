<?php

namespace App\Jobs;

use App\Mail\NotificationMail;
use App\Models\EmailNotification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sentNotificationIds = [];

        $notificationsByUser = EmailNotification::where('was_send', '=', 0)
            ->get()
            ->mapToGroups(function ($item, $key) {
                return [$item->user_id => $item];
            });

        foreach($notificationsByUser as $userId => $notifications)
        {
            $user = User::find($userId);

            Mail::mailer(config('mail.notification'))
                ->to($user)
                ->send(new NotificationMail($notifications, $user->name));

            $sentNotificationIds[] = $notifications->pluck('id')->toArray();
        }

        $sentNotificationIds = array_merge(...$sentNotificationIds);

        EmailNotification::whereIn('id', $sentNotificationIds)->update(['was_send' => 1]);
    }
}
