<?php

namespace App\Jobs\DataFeeds;

use App\Models\DataFeed;
use App\Models\MediaItem;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use SimplePie;
use Stevebauman\Purify\Facades\Purify;
use Throwable;

class GetRssFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dataFeed;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DataFeed $dataFeed)
    {
        $this->dataFeed = $dataFeed;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->getFeed($this->dataFeed);
    }

    private function getFeed($dataFeed) {

        $mediaType = $dataFeed->media_type;
        $feed = $this->setupSimplePieFeed($dataFeed);
        $feedName = $this->formatFeedName($feed->get_title());

        foreach ($feed->get_items() as $item) {

            try {
                $url = $this->formatUrl($item->get_link());

                $existingMedia = MediaItem::where('url', $url)
                    ->where('source_type', DataFeed::class)
                    ->where('source_id', $dataFeed->id)
                    ->first();

                if (!$existingMedia) {

                    $date = Carbon::parse($item->get_date())->format('Y-m-d');
                    $feedImage = $feed->get_image_url();

                    $title = strip_tags($item->get_title());
                    $description = Purify::clean($item->get_content());

                    // TODO: Include embed if Listen Notes?

                    $summary = $this->formatFeedItemSummary($item->get_content(), $feedName, $title);

                    $attributes = [
                        'name' => $title,
                        'type' => 'Article',
                        'url' => $url,
                        'summary' => $summary,
                        'content' => $description,
                        'icon_url' => $feedImage,
                        'source_type' => DataFeed::class,
                        'source_id' => $dataFeed->id,
                        'date' => $date,
                        'media_type' => $mediaType
                    ];

                    MediaItem::create($attributes);

                } else {
                    Log::info('Media Item exists - skipping import' . "\n" . $url);
                }

            } catch (Throwable $exception) {
                Log::warning('Error during GetRssFeed' , [$exception->getMessage()]);
            }
        }
    }

    private function setupSimplePieFeed($dataFeed): SimplePie
    {
        $feed = new SimplePie();
        $feed->set_feed_url($dataFeed->url . '?format=xml');
        $feed->set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36');
        $feed->set_cache_location(storage_path() . '/rss-feeds');

        $stripHtmlTags = $feed->strip_htmltags;
        array_splice($stripHtmlTags, array_search('iframe', $stripHtmlTags), 1);

        $feed->strip_htmltags($stripHtmlTags);

        $feed->init();
        $feed->handle_content_type();

        return $feed;
    }

    private function formatFeedName($originalName): string
    {
        $feedName = html_entity_decode($originalName, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $charactersToReplace = [
            '–' => '-',
        ];

        foreach ($charactersToReplace as $old => $new) {
            $feedName = str_replace($old, $new, $feedName);
        }

        return $feedName;
    }

    private function formatUrl($originalUrl): string
    {
        $partsToReplace = [
            'https://www.google.com/url?rct=j&amp;sa=t&amp;url='
        ];

        $url = str_replace($partsToReplace, '', $originalUrl);
        $urlArray = explode('&', $url);

        return $urlArray[0];
    }

    private function formatFeedItemSummary($content, $feedName, $title): string
    {
        $summary = str_replace(["\r", "\n"], '', Purify::clean($content));
        $summary = strip_tags($summary, ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']);

        $summary = str_replace(['</p>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>'], ' ', $summary);
        $summary = str_replace(['<p>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>'], '', $summary);

        $stringsToRemove = [
            'The post ' . $title . ' appeared first on ' . $feedName . '.',
            'The article ' . $title . ' was originally published on ' . $feedName . '.',
            'Continue reading ' . $title
        ];

        $summary = str_replace($stringsToRemove, '', $summary);

        if (strlen($summary) > 300) {
            $summary = wordwrap($summary, 300);
            $summary = substr($summary, 0, strpos($summary, "\n")) . '...';
        }

        return $summary;
    }
}
