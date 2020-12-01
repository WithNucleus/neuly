<?php

namespace App\Notifications;

use App\Models\Person;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class PersonDeletionRequested extends Notification
{
    /**
     * @var \App\Models\Person
     */
    public $person;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $cause;

    /**
     * @param \App\Models\Feedback $feedback
     */
    public function __construct(Person $person, $name, $email, $cause)
    {
        $this->person = $person;
        $this->name   = $name;
        $this->email  = $email;
        $this->cause  = $cause;
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
            ->line('New Person Deletion Requested')
            ->line('From: ' . $this->name . ' [' . $this->email . ']')
            ->line('Cause: ' . $this->cause)
            ->action('Manage person', route('person.show', $this->person->id));
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $personUrl = route('person.show', $this->person->id);
        $from      = $this->name . ' [' . $this->email . ']';
        $cause     = $this->cause;

        return (new SlackMessage)
            ->content('New Person Deletion Requested')
            ->attachment(function ($attachment) use ($personUrl, $from, $cause) {
                $attachment->title('Manage person', $personUrl)
                    ->fields([
                        'From'  => $from,
                        'Cause' => $cause
                    ]);
            });
    }
}
