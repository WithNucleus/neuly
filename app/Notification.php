<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function scopeUnseen($query)
    {
        return $query->where('was_read', '=', 0);
    }

    public function scopeOfUser($query, $userId)
    {
        return $query->where('user_id', '=', $userId);
    }
}
