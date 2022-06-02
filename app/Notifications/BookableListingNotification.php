<?php

namespace App\Notifications;

use App\Models\BookableListing;
use App\Models\Feedback;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class BookableListingNotification extends Notification
{

    public BookableListing $bookableListing;

    public function __construct(BookableListing $bookableListing)
    {
        $this->bookableListing = $bookableListing;
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
            ->line('Pending Bookable Listing for ' . $this->bookableListing->name)
            ->line('Requested by: ' . $this->bookableListing->user->fullname . ' [' . $this->bookableListing->user->email . ']')
            ->line('Type: ' . $this->bookableListing->type)
            ->line('Location: ' . $this->bookableListing->fullAddress)
            ->action('View in Neuly', route('discover.bookable-listing.show', $this->bookableListing->slug))
            ->line('Hope you have an amazing day!');
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url   = route('discover.bookable-listing.show', $this->bookableListing->slug);
        $type  = $this->bookableListing->type;
        $location = $this->bookableListing->fullAddress;
        $from  = $this->bookableListing->user->fullname . ' [' . $this->bookableListing->user->email . ']';

        return (new SlackMessage)
            ->content('Pending Bookable Listing - ' . $this->bookableListing->name)
            ->attachment(function ($attachment) use ($url, $type, $location, $from) {
                $attachment->title('View in Neuly', $url)
                    ->fields([
                        'Type'  => $type,
                        'Location' => $location,
                        'Requested by'  => $from,
                    ]);
            });
    }
}
