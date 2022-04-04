<?php

namespace App\Notifications;

use App\Models\Patent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class PatentCreated extends Notification
{
    use Queueable;

    private $patent;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Patent $patent)
    {
        $this->patent = $patent;
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
        $adminUrl = route('patent.show', $this->patent->id);

        return (new SlackMessage)->content('A new patent was created: ' . $this->patent->name)
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate patent', $adminUrl)
                    ->fields([
                        'Patent' => $this->patent->name
                    ]);
            });
    }
}
