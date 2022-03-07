<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class EventCreated extends Notification
{
    use Queueable;

    private $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack()
    {
        $url = route('discover.events.show', $this->event->slug);
        $adminUrl = route('event.show', $this->event->id);

        return (new SlackMessage)->content('A new event was created: ' . $this->event->name)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('Show event', $url)
                    ->fields([
                        'Event' => $this->event->name
                    ]);
            })
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate event', $adminUrl)
                    ->fields([
                        'Event' => $this->event->name
                    ]);
            });
    }
}
