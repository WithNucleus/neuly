<?php

namespace App\Notifications;

use App\Models\ListingRequest;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ListingRequestCreated extends Notification
{
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
        $url = route('admin.listingrequest.show', $this->listingRequest->id);

        return (new MailMessage)
            ->line('Listing request created for entity "'.$this->listingRequest->entity_name.'", entity type "'.$this->listingRequest->type.'"')
            ->action('Show Listing Request', $url)
            ->line('Thank you for using our application!');
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url = route('admin.listingrequest.show', $this->listingRequest->id);
        $entityName = $this->listingRequest->entity_name;
        $entityType = $this->listingRequest->type;

        return (new SlackMessage)
            ->content('Listing request created')
            ->attachment(function ($attachment) use ($url, $entityName, $entityType) {
                $attachment->title('Show', $url)
                    ->fields([
                        'Entity Name' => $entityName,
                        'Entity Type' => $entityType,
                    ]);
            });
    }
}
