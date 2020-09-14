<?php

namespace App\Notifications;

use App\Models\ListingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ListingRequestCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var \App\Models\ListingRequest
     */
    public $listingRequest;

    /**
     * @param \App\Models\ListingRequest $listingRequest
     */
    public function __construct(ListingRequest $listingRequest)
    {
        $this->listingRequest = $listingRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->line('Listing request created for entity "' . $this->listingRequest->entity_name . '", entity type "' . $this->listingRequest->type . '"')
            ->action('Show Listing Request', route('listingrequest.show', $this->listingRequest->id))
            ->line('Thank you for using our application!');
    }
}
