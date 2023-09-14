<?php
namespace App\Http\Livewire\Public\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

trait LocalLocationFilter {
    private function getLocalLocation(): void
    {
        try {
            $ipRequest = Http::get('https://freeipapi.com/api/json/' . $this->ip);
            $ipResponse = json_decode($ipRequest->body(), true);

            if (array_key_exists('error', $ipResponse)) {
                Log::info('Error with Neuly Care IP Response', $ipResponse);
            } else {
                $thisLocation = [];

                if (array_key_exists('latitude', $ipResponse) AND array_key_exists('longitude', $ipResponse)) {
                   $this->localLocation['latitude'] = $ipResponse['latitude'];
                   $this->localLocation['longitude'] = $ipResponse['longitude'];

                   $thisLocation['latitude'] = $ipResponse['latitude'];
                   $thisLocation['longitude'] = $ipResponse['longitude'];
                }

                if (array_key_exists('cityName', $ipResponse)) {
                   $this->localLocation['name'] = $ipResponse['cityName'];
                   $thisLocation['name'] = $ipResponse['cityName'];
                } elseif(array_key_exists('regionName', $ipResponse)) {
                    $this->localLocation['name'] = $ipResponse['regionName'];
                    $thisLocation['name'] = $ipResponse['regionName'];
                }

                $this->savedLocations[] = $thisLocation;
            }
        } catch(Throwable $exception) {
            Log::info('Exception with Neuly Care IP Response ' . $exception->getMessage());
        }

    }
}
