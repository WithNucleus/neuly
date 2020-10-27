<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FollowList extends Model
{
    protected $table = 'follow_lists';

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function followItems() {
        return $this->hasMany(Follow::class);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = isset($this->attributes['slug']) ? $this->attributes['slug'] : Str::slug($value);
    }
}
