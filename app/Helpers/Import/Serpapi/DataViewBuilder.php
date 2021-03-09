<?php

namespace App\Helpers\Import\Serpapi;

class DataViewBuilder
{
    public static function buildNestedDataView($data, $output = '')
    {
        if (! is_array($data)) {
            return $data;
        }

        $output .= '<ul>';

        foreach ($data as $label => $value) {
            $output .= '<li>';

            if (is_array($value)) {
                $output = self::buildNestedDataView($value, $output);
            } else {
                $output .= '<span class="bold">'.ucfirst($label).':</span> '.$value;
            }

            $output .= '</li>';
        }

        $output .= '</ul>';

        return $output;
    }
}
