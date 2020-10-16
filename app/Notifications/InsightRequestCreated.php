<?php

namespace App\Notifications;

use App\Models\InsightRequest;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class InsightRequestCreated extends Notification
{
    /**
     * @var \App\Models\InsightRequest
     */
    public $insightRequest;

    /**
     * @param \App\Models\InsightRequest $insightRequest
     */
    public function __construct(InsightRequest $insightRequest)
    {
        $this->insightRequest = $insightRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'slack'];
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
            ->line('New Insight Request')
            ->action('Show Insight Request', route('insightRequest.show', $this->insightRequest->id))
            ->line('Thank you for using our application!');
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url = route('insightRequest.show', $this->insightRequest->id);
        $from = $this->insightRequest->name . ' [' . $this->insightRequest->email . ']';

        return (new SlackMessage)
            ->content('New Insight Request')
            ->attachment(function ($attachment) use ($url, $from) {
                $attachment->title('Show', $url)
                    ->fields([
                        'From' => $from,
                    ]);
            });
    }
}
