<?php

namespace App\Jobs\BookableListings;

use App\Models\BookableListing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetLocationName implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public BookableListing $bookableListing;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BookableListing $bookableListing)
    {
        $this->bookableListing = $bookableListing;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = "https://api.opencagedata.com/geocode/v1/json?q={$this->bookableListing->latitude}+{$this->bookableListing->longitude}&key=0789486fc302430d86d317295c880312";
        try {
            $response = Http::get($url);
            $results = json_decode($response->body(), true);
            $this->bookableListing->geocoding = json_encode($results['results']);
            $this->bookableListing->save();

            try {
                $this->bookableListing->location_name = $results['results'][0]['formatted'];
                $this->bookableListing->save();
            } catch(Throwable $exception) {
                Log::warning('Bad results for Bookable Listing lookup ' . $this->bookableListing->name . "\n" . $exception->getMessage());
            }
        } catch(Throwable $exception) {
            Log::warning('Error when getting location name of Bookable Listing ' . $this->bookableListing->name . "\n" . $exception->getMessage());
        }
    }
}
