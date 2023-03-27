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
            ->markdown('emails.insight-request', [
                'name' => $this->insightRequest->name,
                'text' => $this->insightRequest->text,
            ])
            ->replyTo($this->insightRequest->email)
            ->subject('Insight Request from '.$this->insightRequest->name);
    }

    /**
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url = route('insightRequest.show', $this->insightRequest->id);
        $from = $this->insightRequest->name.' ['.$this->insightRequest->email.']';
        $text = $this->insightRequest->text;

        return (new SlackMessage)
            ->content('New Insight Request from '.$from)
            ->attachment(function ($attachment) use ($url, $text) {
                $attachment->title('View in Neuly', $url)
                    ->fields([
                        'Request' => $text,
                    ]);
            });
    }
}
