<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * @param  string  $string
     * @param  string  $delimiter
     * @return array
     */
    public static function explodeAndFilterEmpty($string, $delimiter)
    {
        if (is_string($string) === false) {
            return [];
        }

        return array_filter(array_map('trim', explode($delimiter, $string)));
    }
}
