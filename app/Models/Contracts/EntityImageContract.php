<?php

namespace App\Models\Contracts;

interface EntityImageContract
{
    public function getEntityImageUrlAttribute();

    public static function getImageUrlPrefix();
}
