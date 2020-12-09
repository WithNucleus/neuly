<?php

namespace App\Listeners;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailNotification
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered|\App\Events\RegisteredAndVerified $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->user instanceof Authenticatable) {
            Mail::to($event->user)->send(new WelcomeMail($event->user->name));
        }
    }
}
