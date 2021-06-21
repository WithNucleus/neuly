<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchAPI extends Model
{
    public static function googleScholar($query, $start = null)
    {
        $apiKey = config('services.serpapi.private_api_key');

        if (empty($apiKey)) {
            throw new \Exception('SerpAPI key is not defined!');
        }

        $query = urlencode($query);
        $url = 'https://serpapi.com/search.json?engine=google_scholar&q='.$query.'&hl=en&filter=0&api_key='.$apiKey;

        if ($start !== null) {
            $url .= '&start='.$start;
        }

        $headers = [
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json_results = curl_exec($ch);
        curl_close($ch);
        $results = json_decode($json_results);

        return $results;
    }
}
