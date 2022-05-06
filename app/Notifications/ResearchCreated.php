<?php

namespace App\Notifications;

use App\Models\Research;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ResearchCreated extends Notification
{
    use Queueable;

    private $research;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Research $research)
    {
        $this->research = $research;
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
        $url = route('discover.research.show', $this->research->slug);
        $adminUrl = route('research.show', $this->research->id);

        return (new SlackMessage)->content('A new research was created: ' . $this->research->name)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('Show research', $url)
                    ->fields([
                        'Research' => $this->research->name
                    ]);
            })
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate research', $adminUrl)
                    ->fields([
                        'Research' => $this->research->name
                    ]);
            });
    }
}
