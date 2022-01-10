<?php

namespace App\Models;

use App\Models\Contracts\MediaTypesContract;
use App\Models\Traits\HasMediaTypes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DataFeed extends Model implements MediaTypesContract
{
    use CrudTrait, HasMediaTypes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'data_feeds';
    protected $guarded = ['id'];

    const FEED_TYPE_RSS = 'RSS';

    const FEED_TYPES = [
        self::FEED_TYPE_RSS
    ];

    const SOURCE_CATEGORIES = [
        'Media Outlet',
        'News',
        'Forums',
        'Non-Profit',
        'Video',
        'Mindfulness',
        'Google Alert',
        'Podcast'
    ];

    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function getFeedTypes(): array
    {
        return array_combine(self::FEED_TYPES, self::FEED_TYPES);
    }

    public static function getSourceCategories(): array
    {
        return array_combine(self::SOURCE_CATEGORIES, self::SOURCE_CATEGORIES);
    }

    public static function getStatuses(): array
    {
        return array_combine(self::STATUSES, self::STATUSES);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function mediaItems(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(MediaItem::class, 'source')->orderBy('date', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

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
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }
}
