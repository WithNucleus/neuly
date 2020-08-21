<?php

namespace App\Listeners;

use App\Events\SendNotification;
use App\Models\Follow;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CreateAppNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendNotification  $event
     * @return void
     */
    public function handle(SendNotification $event)
    {
        $users = Follow::where('followable_id', '=', $event->id)
            ->where('followable_type', '=', $event->type)
            ->where('app_notification', '=', 1)
            ->get(['user_id']);

        foreach($users as $user)
        {
            $notification = new Notification();
            $notification->user_id = $user->user_id;
            $notification->notifier_id = $event->id;
            $notification->notifier_type = $event->type;
            $notification->title = $event->title;
            $notification->message = $event->message;
            $notification->save();
        }
    }
}
