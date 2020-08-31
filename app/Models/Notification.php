<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Model
{
	protected $table = 'notifications';
    protected $guarded = ['id'];

    public function scopeUnseen($query)
    {
        return $query->where('was_read', '=', 0);
    }

    public function scopeOfUser($query, $userId)
    {
        return $query->where('user_id', '=', $userId);
    }

    public function notifier()
    {
        return $this->morphTo();
    }
}
