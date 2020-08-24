<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Redirect extends Model
{
    use CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'old_slug',
    ];

    /**
     * Get the redirectable model of the redirect record
     *
     * @return MorphTo
     */
    public function redirectable() :MorphTo
    {
        return $this->morphTo();
    }
}
