<?php

namespace App\Models;

use App\Models\Traits\HasMediaTypes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    use CrudTrait, HasMediaTypes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    const STATUS_PUBLIC = 'Public';
    const STATUS_PENDING = 'Pending';

    const STATUSES = [
        self::STATUS_PUBLIC,
        self::STATUS_PENDING
    ];

    protected $table = 'media_items';
    protected $guarded = ['id'];
     protected $dates = ['date'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getStatuses(): array
    {
        return array_combine(self::STATUSES, self::STATUSES);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function focus(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Focus::class, 'focus_media_item', 'media_item_id', 'focus_id');
    }

    public function source(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopePublic($query)
    {
        $query->where('status', self::STATUS_PUBLIC);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
