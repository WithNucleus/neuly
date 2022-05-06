<?php

namespace App\Notifications;

use App\Models\Investor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class InvestorCreated extends Notification
{
    use Queueable;

    private $investor;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Investor $investor)
    {
        $this->investor = $investor;
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
        $url = route('discover.investors.show', $this->investor->slug);
        $adminUrl = route('investor.show', $this->investor->id);

        return (new SlackMessage)->content('A new investor was created: ' . $this->investor->name)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('Show investor', $url)
                    ->fields([
                        'Investor' => $this->investor->name
                    ]);
            })
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate investor', $adminUrl)
                    ->fields([
                        'Investor' => $this->investor->name
                    ]);
            });
    }
}
