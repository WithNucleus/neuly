<?php

namespace App\Notifications;

use App\Models\Redirect;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SlugUpdated extends Notification
{
    use Queueable;

    public $sluggable;

    /** @var Redirect */
    public $redirect;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sluggable, Redirect $redirect)
    {
        $this->sluggable = $sluggable;
        $this->redirect = $redirect;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Updated the slug of '.ucfirst($this->sluggable->getMorphClass()).' sluggable model.')
                    ->action('See More', backpack_url('redirect/'.$this->redirect->id.'/show'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
