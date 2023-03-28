<?php

namespace App\Notifications;

use App\Models\RaisedClaim;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class RaisedClaimCreated extends Notification
{
    /**
     * @var \App\Models\RaisedClaim
     */
    public $claim;

    /**
     * @param  \App\Models\Feedback  $feedback
     */
    public function __construct(RaisedClaim $claim)
    {
        $this->claim = $claim;
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
            ->line('New person claim was raised')
            ->line('From: '.$this->claim->user->fullname.' ['.$this->claim->user->email.']')
            ->line('Person: '.$this->claim->person->name)
            ->line('Comment: '.$this->claim->comment)
            ->action('Manage claim', route('person-claim.show', $this->claim->id));
    }

    /**
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $claimUrl = route('person-claim.show', $this->claim->id);
        $fields = [
            'From' => $this->claim->user->fullname.' ['.$this->claim->user->email.']',
            'Person' => $this->claim->person->name,
            'Comment' => $this->claim->comment,
        ];

        return (new SlackMessage)
            ->content('New person claim was raised')
            ->attachment(function ($attachment) use ($claimUrl, $fields) {
                $attachment->title('Manage claim', $claimUrl)->fields($fields);
            });
    }
}
