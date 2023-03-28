<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class DemoRequestNotification extends Notification
{
    /**
     * @var \App\Models\Feedback
     */
    public $feedback;

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
            ->line('Demo Request - '.$this->feedback->organization)
            ->line('Requested by: '.$this->feedback->user_name.' ['.$this->feedback->user_email.']')
            ->line('Title / Role: '.$this->feedback->job_title)
            ->line($this->feedback->content)
            ->action('View in Neuly', route('feedback.show', $this->feedback->id))
            ->line('Hope you have an amazing day!');
    }

    /**
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url = route('feedback.show', $this->feedback->id);
        $type = $this->feedback->type;
        $content = $this->feedback->content;
        $from = $this->feedback->user_name.' ['.$this->feedback->user_email.']';

        return (new SlackMessage)
            ->content('Demo Request')
            ->attachment(function ($attachment) use ($url, $type, $content, $from) {
                $attachment->title('View in Neuly', $url)
                    ->fields([
                        'Organization' => $type,
                        'From' => $from,
                        'How would you like to use Neuly?' => $content,
                    ]);
            });
    }
}
