<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FollowList extends Model
{
    protected $table = 'follow_lists';

    /**
     * RELATIONS
     */

    public function user() {
        return $this->belongsTo(\App\User::class);
    }

    public function followItems() {
        return $this->hasMany(\App\Models\Follow::class);
    }

    /**
     * MUTATORS
     */

    public function setNameAttribute($value) {

        $this->attributes['name'] = $value;

        $this->attributes['slug'] = isset($this->attributes['slug']) ? $this->attributes['slug'] : Str::slug($value);
    }
}
