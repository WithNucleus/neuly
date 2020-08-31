<?php

namespace App\Helpers;

class NotificationHelper
{
    public static function getType($object)
    {
        return get_class($object);
    }
}
