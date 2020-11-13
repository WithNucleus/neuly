<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Contracts\EntityImageContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\EntityImage;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model implements EntityContract, EntityImageContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;
    use EntityImage;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'events';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    protected static $imageAttribute = 'image';
    protected static $imageFolderPath = 'events';
    protected static $imageFilenameAttribute = 'name';

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

    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_event', 'event_id', 'company_id')->withTimestamps();
    }

    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'event_focus', 'event_id', 'focus_id')->withTimestamps();
    }

    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'event_location', 'event_id', 'location_id')->withTimestamps();
    }

    public function people() {
        return $this->belongsToMany('App\Models\Person', 'event_person', 'event_id', 'person_id')->withTimestamps();
    }

    public function eventTypes() {
        return $this->belongsToMany('App\Models\EventType', 'event_event_type', 'event_id', 'event_type_id')->withTimestamps();
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
            'start_date'       => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'end_date'         => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'event_url'        => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'registration_url' => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'description'      => [
                'type'  => EntityMergeHelper::TYPE_TEXT,
                'label' => 'Type',
            ],
            'image'            => [
                'type'  => EntityMergeHelper::TYPE_IMAGE,
                'label' => 'Type',
            ],
            //relations
            'eventTypes'       => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'focus'            => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'locations'        => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people'           => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'companies'        => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
                'label'         => 'Exhibitors'
            ],
        ];
    }
}
