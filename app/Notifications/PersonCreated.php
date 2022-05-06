<?php

namespace App\Notifications;

use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class PersonCreated extends Notification
{
    use Queueable;

    private $person;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
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
        $url = route('discover.people.show', $this->person->slug);
        $adminUrl = route('person.show', $this->person->id);

        return (new SlackMessage)->content('A new person was created: ' . $this->person->name)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('Show person', $url)
                    ->fields([
                        'Person' => $this->person->name
                    ]);
            })
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate person', $adminUrl)
                    ->fields([
                        'Person' => $this->person->name
                    ]);
            });
    }
}
