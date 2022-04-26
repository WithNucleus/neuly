<?php

namespace App\Notifications;

use App\Models\MediaItem;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class DuplicateMediaItem extends Notification
{
    use Queueable;

    protected MediaItem $mediaItem;
    protected Collection $duplicates;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MediaItem $mediaItem, Collection $duplicates)
    {
        $this->mediaItem = $mediaItem;
        $this->duplicates = $duplicates;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(): SlackMessage
    {
        $url = route('admin.media-item.show', $this->mediaItem->id);

        $title = 'Incoming Media Item with Duplicates';

        $slackMessage = (new SlackMessage)->content($title)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title($this->mediaItem->name, $url)
                    ->fields([
                        'Source' => $this->mediaItem->source->name,
                        'Status' => $this->mediaItem->status,
                        'URL' => $this->mediaItem->url
                ]);
            });

        foreach ($this->duplicates as $duplicate) {
            $url = route('admin.media-item.show', $duplicate->id);
            $title = $duplicate->status . ': ' . $duplicate->source->name . ' ' . Carbon::parse($duplicate->date)->format('Y-m-d');

            $slackMessage->attachment(function ($attachment) use ($title, $url) {
                $attachment->title($title, $url);
            });
        }

        return $slackMessage;
    }
}
