<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $notifications;

    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notifications, $name)
    {
        $this->notifications = $notifications;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.notifications')
            ->with([
                'name' => $this->name,
                'notifications' => $this->notifications,
            ])
            ->subject('Your Weekly Update from Neuly');
    }
}
