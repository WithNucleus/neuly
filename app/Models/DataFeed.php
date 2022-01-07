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
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    const FEED_TYPES = [
        'RSS'
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
