<?php

namespace App\Notifications\Metrics;

use App\Models\Metric;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class DailyMetrics extends Notification
{
    use Queueable;

    protected Metric $metric;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Metric $metric)
    {
        $this->metric = $metric;
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

    public function toSlack() {

        $url = route('admin.metric.show', $this->metric->id);

        return (new SlackMessage)->content('Daily Metrics for ' . Carbon::now()->format('Y-m-d'))
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('View Metrics', $url)
                    ->fields([
                        'Organizations' => $this->metric->organizations,
                        'People' => $this->metric->people,
                        'Investors' => $this->metric->investors,
                        'Events Total' => $this->metric->events_total,
                        'Events Upcoming' => $this->metric->events_upcoming,
                        'Events Past' => $this->metric->events_past,
                        'Jobs Total' => $this->metric->jobs_total,
                        'Jobs Open' => $this->metric->jobs_open,
                        'Jobs Archived' => $this->metric->jobs_archived,
                        'Media Items Total' => $this->metric->media_items_total,
                        'News' => $this->metric->news,
                        'Articles' => $this->metric->articles,
                        'Images' => $this->metric->images,
                        'Videos' => $this->metric->videos,
                        'Mixed Media' => $this->metric->mixed_media,
                        'Podcasts' => $this->metric->podcasts,
                        'Books' => $this->metric->books,
                        'Courses' => $this->metric->courses,
                        'Patent Filings' => $this->metric->patent_filings,
                        'Patents' => $this->metric->patents,
                    ]);
            });
    }
}
