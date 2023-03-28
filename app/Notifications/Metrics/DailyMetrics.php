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
     */
    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(): SlackMessage
    {
        $url = route('admin.metric.show', $this->metric->id);

        $title = 'Neuly '.ucfirst($this->metric->frequency).' Metrics '.Carbon::now()->format('Y-m-d');

        return (new SlackMessage)->content($title)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('View All Metrics', $url)
                    ->fields([
                        'Organizations' => $this->metric->organizations,
                        'People' => $this->metric->people,
                        'Investors' => $this->metric->investors,
                        'Clinical Trials' => $this->metric->clinical_trials,
                        'Research' => $this->metric->research,
                        'Locations' => $this->metric->locations,
                        'Courses' => $this->metric->courses,
                        'Patents' => $this->metric->patents,
                        'Bookable Listings' => $this->metric->bookable_listings,
                    ]);
            })
            ->attachment(function ($attachment) use ($url) {
                $attachment->title($this->metric->events_total.' Events', $url)
                    ->fields([
                        'Upcoming' => $this->metric->events_upcoming,
                        'Past' => $this->metric->events_past,
                    ]);
            })
            ->attachment(function ($attachment) use ($url) {
                $attachment->title($this->metric->jobs_total.' Jobs', $url)
                    ->fields([
                        'Open' => $this->metric->jobs_open,
                        'Archived' => $this->metric->jobs_archived,
                    ]);
            })
            ->attachment(function ($attachment) use ($url) {
                $attachment->title($this->metric->media_items_total.' Media Items', $url)
                    ->fields([
                        'News' => $this->metric->news,
                        'Articles' => $this->metric->articles,
                        'Images' => $this->metric->images,
                        'Videos' => $this->metric->videos,
                        'Mixed Media' => $this->metric->mixed_media,
                        'Podcasts' => $this->metric->podcasts,
                        'Books' => $this->metric->books,
                        'Patent Filings' => $this->metric->patent_filings,
                    ]);
            });
    }
}
