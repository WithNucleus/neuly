<?php

namespace App\Models;

use App\Models\Traits\HasMediaTypes;
use App\Models\Traits\SearchableEntity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MediaItem extends Model
{
    use CrudTrait,
        HasMediaTypes,
        LogsActivity,
        SearchableEntity;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    const STATUS_PUBLIC = 'Public';
    const STATUS_PENDING = 'Pending';
    const STATUS_DECLINED = 'Declined';
    const STATUS_DUPLICATE = 'Duplicate';

    const STATUSES = [
        self::STATUS_PUBLIC,
        self::STATUS_PENDING,
        self::STATUS_DECLINED,
        self::STATUS_DUPLICATE
    ];

    protected $table = 'media_items';
    protected $guarded = ['id'];
    protected $dates = ['date'];

    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getStatuses(): array
    {
        return array_combine(self::STATUSES, self::STATUSES);
    }

    public function shouldBeSearchable()
    {
        return $this->status === self::STATUS_PUBLIC;
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

    public function companies(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Company::class, 'entity' , 'media_item_relationships')->withTimestamps();
    }

    public function people(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Person::class, 'entity' , 'media_item_relationships')->withTimestamps();
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
    public function scopePending($query)
    {
        $query->where('status', self::STATUS_PENDING);
    }

    public function scopePublic($query)
    {
        $query->where('status', self::STATUS_PUBLIC);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getFormattedContentAttribute(): string
    {
        return nl2br(e($this->content));
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
