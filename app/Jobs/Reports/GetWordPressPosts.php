<?php

namespace App\Jobs\Reports;

use App\Jobs\AutoTag\TagReport;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class GetWordPressPosts implements ShouldQueue
{
    protected int $pageNumber;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(int $pageNumber = 1)
    {
        $this->pageNumber = $pageNumber;
    }

    public function handle()
    {
        $username = config('services.wordpress.username');
        $password = config('services.wordpress.password');

        $rest_api_url = config('services.wordpress.url') . "/wp-json/wp/v2/posts?_embed";

        $response = Http::withBasicAuth($username, $password)
            ->get($rest_api_url, [
                'per_page' => 100,
                'status' => 'publish',
                'page' => $this->pageNumber,
                'categories' => 199
            ]);

        $results = $response->json();

        foreach ($results as $wpPost) {

            try {
                $report = Report::find($wpPost['id']);

                if ($report) {
                    $report->update([
                        'content' => html_entity_decode($wpPost['content']['rendered']),
                    ]);
                    $report->refresh();
                } else {
                    $report = Report::create([
                        'date' => Carbon::parse($wpPost['date'])->format('Y-m-d H:i:s'),
                        'name' => html_entity_decode($wpPost['title']['rendered']),
                        'slug' => $wpPost['slug'],
                        'status' => $wpPost['status'],
                        'sticky' => $wpPost['sticky'],
                    ]);
                }

                if ($report->excerpt === NULL) {
                    $excerpt = strip_tags(html_entity_decode($wpPost['content']['rendered']));
                    $report->excerpt = Str::words($excerpt, 20);
                    $report->save();
                }

                if ($report->image === NULL) {
                    if ($wpPost['featured_image_url'] != '') {
                        $fileUrl = $wpPost['featured_image_url'];
                        $extension = pathinfo(parse_url($fileUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                        $filename = 'report-' . $report->id . '.' . $extension;
                        $file = file_get_contents($fileUrl);
                        Storage::disk('local')->put('public/reports/' . $filename, $file);
                        $report->image = $filename;
                        $report->save();
                    }
                }

                TagReport::dispatch($report);
            } catch (Throwable $exception) {
                Log::warning('Exception during GetWordPressPosts ' . $exception->getMessage());
            }
        }

        if (count($results) == 100) {
            GetWordPressPosts::dispatch($this->pageNumber + 1);
        }
    }
}
