<?php

namespace App\Models;

use App\Models\Contracts\EntityImageContract;
use App\Models\Traits\EntityImage;
use App\Models\Traits\SearchableEntity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model implements EntityImageContract
{
    use CrudTrait;
    use EntityImage;
    use SearchableEntity;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'news_articles';

    protected $guarded = ['id'];

    protected static $imageAttribute = 'image';

    protected static $imageFolderPath = 'news';

    protected static $imageFilenameAttribute = 'name';

    protected $casts = [
        'date' => 'date',
    ];

    private $searchableModelName = 'News Article';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function focus()
    {
        return $this->belongsToMany('App\Models\Focus', 'focus_news_article', 'news_article_id', 'focus_id')->withTimestamps();
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

    public function setImageAttribute($value)
    {
        $this->updateImageAttribute($value);
    }
}
