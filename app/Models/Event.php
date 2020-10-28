<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model implements EntityContract
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

    protected $table = 'events';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

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

        $title = Str::slug($this->name);
        $date = $this->start_date;
        $filename = 'event-' . $date . '-' . $title . '.png';
        $attribute_name = "image";
        $disk = 'local';
        $destination_path = "public/events";

        // if the image was erased
        if ($value==null) {
            Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            $image = Image::make($value)->encode('png', 90);
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            Storage::disk($disk)->delete($this->{$attribute_name});

            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
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
