<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class DataFeed extends Model
{
    use CrudTrait;

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
        'Google Alert'
    ];

    const MEDIA_TYPES = [
        'Article',
        'Image',
        'Video',
        'Mixed',
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

    public static function getMediaTypes(): array
    {
        return array_combine(self::MEDIA_TYPES, self::MEDIA_TYPES);
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
}
