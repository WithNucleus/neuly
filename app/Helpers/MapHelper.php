<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class MapHelper
{
    /**
     * @param $country
     * @return array $map
     */
    public static function getCountryMap(string $country)
    {
        $countries_with_maps = [
            'USA' => [
                'code' => 'US',
                'map_name' => 'us_merc',
            ],
            'Canada' => [
                'code' => 'CA',
                'map_name' => 'ca_lcc',
            ],
            'Australia' => [
                'code' => 'AU',
                'map_name' => 'au_mill',
            ],
            'Netherlands' => [
                'code' => 'NL',
                'map_name' => 'nl_merc',
            ],
            'Germany' => [
                'code' => 'DE',
                'map_name' => 'de_merc',
            ],
            'France' => [
                'code' => 'FR',
                'map_name' => 'fr_regions_2016_merc',
            ],
            'United Kingdom' => [
                'code' => 'UK',
                'map_name' => 'uk_countries_merc',
            ],
            'Austria' => [
                'code' => 'AT',
                'map_name' => 'at_merc',
            ],
            'Belgium' => [
                'code' => 'BE',
                'map_name' => 'be_merc',
            ],
            'China' => [
                'code' => 'CN',
                'map_name' => 'cn_merc',
            ],
            'Italy' => [
                'code' => 'IT',
                'map_name' => 'it_regions_merc',
            ],
            'Spain' => [
                'code' => 'ES',
                'map_name' => 'es_merc',
            ],
            'Switzerland' => [
                'code' => 'CH',
                'map_name' => 'ch_merc',
            ],
        ];

        $country = Str::ucfirst($country);

        if (array_key_exists($country, $countries_with_maps)) {
            $map = [
                'show' => true,
                'code' => $countries_with_maps[$country]['code'],
                'map_name' => $countries_with_maps[$country]['map_name'],
            ];
        } else {
            $map = [
                'show' => false,
                'code' => '',
                'map_name' => '',
            ];
        }

        return $map;
    }
}
