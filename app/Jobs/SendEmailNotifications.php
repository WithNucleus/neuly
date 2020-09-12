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




        $notificationsByUser = EmailNotification::where('was_send', '=', 0)
            ->get()
            ->mapToGroups(function ($item, $key) {
                return [$item->user_id => $item];
            });

        foreach($notificationsByUser as $userId => $notifications)
        {
            $user = User::find($userId);

            Mail::to($user)->send(new NotificationMail($notifications, $user->name));

            foreach($notifications as $notification)
            {
                $notification->was_send = 1;
                $notification->save();
            }
        }
    }
}
