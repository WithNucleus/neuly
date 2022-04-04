<?php

namespace App\Notifications;

use App\Models\MediaItem;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class MediaItemApproved extends Notification
{
    use Queueable;

    private $mediaItem;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MediaItem $mediaItem)
    {
        $this->mediaItem = $mediaItem;
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

    public function toSlack($notifiable)
    {
        $adminUrl = route('admin.media-item.show', $this->mediaItem->id);

        return (new SlackMessage)->content('A new ' . $this->mediaItem->media_type . ' was apporved: ' . $this->mediaItem->name)
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate ' . $this->mediaItem->media_type, $adminUrl)
                    ->fields([
                        $this->mediaItem->media_type  => $this->mediaItem->name
                    ]);
            });
    }

}
