<?php

namespace App\Notifications;

use App\Models\Feedback;
use App\Models\InsightRequest;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class EnterpriseWidgetNotification extends Notification
{
    /**
     * @var \App\Models\InsightRequest
     */
    public Feedback $feedback;

    /**
     * @param Feedback $feedback
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
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
            ->markdown('emails.enterprise-request', [
                'name' => $this->feedback->user_name,
                'content' => $this->feedback->content
            ])
            ->replyTo($this->feedback->user_email)
            ->subject('Enterprise Widget Request from ' . $this->feedback->user_name);
    }

    /**
     * @param mixed $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url = route('feedback.show', $this->feedback->id);
        $from = $this->feedback->user_name . ' [' . $this->feedback->user_email . ']';
        $content = $this->feedback->content;

        return (new SlackMessage)
            ->content('Enterprise Widget Request from ' . $from)
            ->attachment(function ($attachment) use ($url, $content) {
                $attachment->title('View in Neuly', $url)
                    ->fields([
                        'Request' => $content,
                    ]);
            });
    }
}
