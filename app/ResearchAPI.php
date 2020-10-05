<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchAPI extends Model
{
    /*
    *  Google Scholar
    *
    */
    public static function googleScholar($query, $start = NULL) {

        if ($start == NULL) {
            $url = 'https://serpapi.com/search.json?engine=google_scholar&q=' . $query . '&hl=en&filter=0&api_key=' . config('import-api-keys.serpapi_key', false);
        } else {
            $url = 'https://serpapi.com/search.json?engine=google_scholar&q=' . $query . '&hl=en&filter=0&start=' . $start . '&api_key=' . config('import-api-keys.serpapi_key', false);
        }

        $headers = array(
            'Content-Type: application/json',
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        $json_results = curl_exec($ch);
        curl_close($ch);
        $results = json_decode($json_results);

        return $results;
    }
}
