<?php

namespace App\Notifications;

use App\Models\Location;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class LocationMapCodesNotFound extends Notification
{
    /**
     * @var \App\Models\Location
     */
    protected $location;

    /**
     * @var bool
     */
    protected $countryCodeNotFound;

    /**
     * @var bool
     */
    protected $regionCodeNotFound;

    /**
     * @param \App\Models\Location $feedback
     */
    public function __construct(Location $location, $countryCodeNotFound, $regionCodeNotFound)
    {
        $this->location = $location;
        $this->countryCodeNotFound = $countryCodeNotFound;
        $this->regionCodeNotFound = $regionCodeNotFound;
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
            ->line('Location added/updated with empty map codes')
            ->line('Name: '.$this->location->name)
            ->line('Country code found: '.($this->countryCodeNotFound ? 'No' : 'Yes'))
            ->line('Region code found: '.($this->regionCodeNotFound ? 'No' : 'Yes'))
            ->action('Manage location', route('location.show', $this->location->id))
            ->line('Thank you for using our application!');
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url = route('location.show', $this->location->id);
        $fields = [
            'Name' => $this->location->name,
            'Country code found' => $this->countryCodeNotFound ? 'No' : 'Yes',
            'Region code found' => $this->regionCodeNotFound ? 'No' : 'Yes',
        ];

        return (new SlackMessage)
            ->content('Location added/updated with empty map codes')
            ->attachment(function ($attachment) use ($url, $fields) {
                $attachment->title('Manage location', $url)
                    ->fields($fields);
            });
    }
}
