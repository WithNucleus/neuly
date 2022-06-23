<?php

namespace App\Jobs\Metrics;

use App\Helpers\NotificationHelper;
use App\Models\BookableListing;
use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Course;
use App\Models\Event;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Models\MediaItem;
use App\Models\Metric;
use App\Models\Patent;
use App\Models\Person;
use App\Models\Research;
use App\Notifications\Metrics\DailyMetrics;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class CollectMetrics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = Carbon::now()->format('Y-m-d');
        $organizations = Company::count();
        $people = Person::public()->count();
        $investors = Investor::count();
        $clinical_trials = Clinicaltrial::count();
        $research = Research::count();
        $locations = Location::count();
        $events_total = Event::count();
        $events_upcoming = Event::upcoming()->count();
        $events_past = Event::past()->count();
        $jobs_total = Job::count();
        $jobs_open = Job::open()->count();
        $jobs_archived = Job::archived()->count();
        $media_items_total = MediaItem::public()->count();
        $news = MediaItem::news()->public()->count();
        $articles = MediaItem::articles()->public()->count();
        $images = MediaItem::images()->public()->count();
        $videos = MediaItem::videos()->public()->count();
        $mixed_media = MediaItem::mixed()->public()->count();
        $podcasts = MediaItem::podcasts()->public()->count();
        $books = MediaItem::books()->public()->count();
        $patent_filings = MediaItem::patentFilings()->public()->count();
        $courses = Course::count();
        $patents = Patent::count();
        $bookableListings = BookableListing::count();

        $metric = Metric::create([
            'date' => $date,
            'organizations' => $organizations,
            'people' => $people,
            'investors' => $investors,
            'research' => $research,
            'locations' => $locations,
            'clinical_trials' => $clinical_trials,
            'events_total' => $events_total,
            'events_upcoming' => $events_upcoming,
            'events_past' => $events_past,
            'jobs_total' => $jobs_total,
            'jobs_open' => $jobs_open,
            'jobs_archived' => $jobs_archived,
            'media_items_total' => $media_items_total,
            'news' => $news,
            'articles' => $articles,
            'images' => $images,
            'videos' => $videos,
            'mixed_media' => $mixed_media,
            'podcasts' => $podcasts,
            'books' => $books,
            'patent_filings' => $patent_filings,
            'courses' => $courses,
            'patents' => $patents,
            'bookable_listings' => $bookableListings,
        ]);

        MetricsChange::dispatch($metric, Metric::TYPE_CHANGE, Metric::FREQUENCY_DAILY);
        NotificationHelper::sendSlackNotification(new DailyMetrics($metric), 'metrics');
    }
}
