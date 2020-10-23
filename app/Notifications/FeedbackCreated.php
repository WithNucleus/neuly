<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class FeedbackCreated extends Notification
{
    /**
     * @var \App\Models\Feedback
     */
    public $feedback;

    /**
     * @param \App\Models\Feedback $feedback
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('New Feedback')
            ->line('Title: ' . $this->feedback->title)
            ->line('Type: ' . $this->feedback->type)
            ->line('From: ' . $this->feedback->user_name . ' [' . $this->feedback->user_email . ']')
            ->action('Show', route('feedback.show', $this->feedback->id))
            ->line('Thank you for using our application!');
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url   = route('feedback.show', $this->feedback->id);
        $title = $this->feedback->title;
        $type  = $this->feedback->type;
        $from  = $this->feedback->user_name . ' [' . $this->feedback->user_email . ']';

        return (new SlackMessage)
            ->content('New Feedback')
            ->attachment(function ($attachment) use ($url, $title, $type, $from) {
                $attachment->title('Show', $url)
                    ->fields([
                        'Title' => $title,
                        'Type'  => $type,
                        'From'  => $from,
                    ]);
            });
    }
}
