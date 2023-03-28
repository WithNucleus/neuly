<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankableEntity extends Model
{
    public $timestamps = false;

    protected $table = 'rankable_entities';

    protected $guarded = ['ranked_list_id'];

    public function rankable()
    {
        return $this->morphTo();
    }

    public function list()
    {
        return $this->belongsTo(RankedList::class);
    }
}
