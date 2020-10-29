<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Research extends Model implements EntityContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'research';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getShowLink() {
        return '<a href="' . route('discover.research.show', $this->slug) . '">' . $this->name . '</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'focus_research', 'research_id', 'focus_id')
                    ->withTimestamps();
    }

    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_research', 'research_id', 'company_id')
                    ->withTimestamps();
    }

    public function people() {
        return $this->belongsToMany('App\Models\Person', 'person_research', 'research_id', 'person_id')
                    ->withTimestamps();
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

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = isset($this->attributes['slug']) ? $this->attributes['slug'] : Str::slug($value);
    }

    /**
     * @return array
     */
    public static function getMergeMapping()
    {
        return [
            //attributes
            'name'             => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'slug'             => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'abstract'         => [
                'type' => EntityMergeHelper::TYPE_TEXT,
            ],
            'link'             => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'publish_date'     => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'publication_info' => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'api_identifier'   => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'resources'        => [
                'type' => EntityMergeHelper::TYPE_TEXT,
            ],
            //relations
            'focus'            => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'companies'        => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people'           => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
        ];
    }
}
