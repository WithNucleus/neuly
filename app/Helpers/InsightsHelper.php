<?php

namespace App\Helpers;

class InsightsHelper
{
    /**
     * @param  int  $length
     * @return array
     */
    public static function getChartColors($length)
    {
        //TODO: fixed colors for all charts. Only 15 colors now, extend if needed more
        $chartColors = [
            '#A7ABDD',
            '#6BBCA4',
            '#275DAD',
            '#73FBD3',
            '#2E8B57',
            '#2F4F4F',
            '#6495ED',
            '#F08080',
            '#FFD700',
            '#006400',
            '#F4A460',
            '#4B0082',
            '#696969',
            '#FFB6C1',
            '#FFA500',
        ];

        return array_slice($chartColors, 0, $length);

        //TODO: random colors for each chart every page view. Unlimited
//        $chartColors = [];
//
//        for ($i = 0; $i < $length; $i++) {
//            $chartColors[] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
//        }
//
//        return $chartColors;
    }
}
