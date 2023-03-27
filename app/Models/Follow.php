<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Follow extends Model
{
    protected $table = 'followables';

    protected $guarded = ['id'];

    /**
     * RELATIONS
     */
    public function followable(): MorphTo
    {
        return $this->morphTo();
    }

    public function list()
    {
        return $this->belongsTo(FollowList::class, 'follow_list_id');
    }
}
