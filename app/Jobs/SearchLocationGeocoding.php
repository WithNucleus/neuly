<?php

namespace App\Jobs;

use App\Models\Location;
use App\Models\LocationsGeocoding;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use OpenCage\Geocoder\Geocoder;

class SearchLocationGeocoding implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $locationGeocoding;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(LocationsGeocoding $locationGeocoding)
    {
        $this->locationGeocoding = $locationGeocoding;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $processed = [];
        $failed = [];

        try {
            $apiKey = config('services.opencage.api_key');
            $geocoder = new Geocoder($apiKey);

            foreach ($this->locationGeocoding->payload as $locationId => $locationName) {
                $result = $geocoder->geocode($locationName);

                if ($result && $result['total_results'] > 0) {
                    $geocodingData = $result['results'][0];
                    $longitude = $geocodingData['geometry']['lng'] ? $geocodingData['geometry']['lng'] : null;
                    $latitude = $geocodingData['geometry']['lat'] ? $geocodingData['geometry']['lat'] : null;

                    Location::where('id', $locationId)->update([
                        'longitude' => $longitude,
                        'latitude' => $latitude,
                    ]);

                    $processed[$locationId] = [
                        'name' => $locationName,
                        'longitude' => $longitude,
                        'latitude' => $latitude,
                    ];
                } else {
                    $message = isset($result['status']['message']) ? $result['status']['message'] : 'Unknown error';
                    $failed[$locationId] = [
                        'name' => $locationName,
                        'message' => $message,
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error('An error occurred while trying to search locations geocoding. Error message: '.$e->getMessage());
        }

        $this->locationGeocoding->processed = $processed;
        $this->locationGeocoding->failed = $failed;
        $this->locationGeocoding->finished_at = Carbon::now();
        $this->locationGeocoding->save();
    }
}
