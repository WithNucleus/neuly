<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportResult extends Model
{
    const TYPE_CLINICAL_TRIALS = 'clinical_trials';
    const TYPE_RELATED_ENTITIES_LOCATION = 'related_entities_locations';
    const TYPE_RELATED_ENTITIES_PEOPLE_ORGANIZATION = 'related_entities_people_organisation';
    const TYPE_BATCH_IMAGES_UPLOAD = 'batch_images_upload';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

	protected $table = 'import_results';
    protected $guarded = ['id'];

    protected $casts = [
        'options' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function focus() {
        return $this->belongsTo('App\Models\Focus');
    }

    public function failures()
    {
        return $this->hasMany('App\Models\ImportFailure', 'import_result_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeClinicalTrials($query)
    {
        return $query->where('type', self::TYPE_CLINICAL_TRIALS);
    }

    public function scopeRelatedEntitiesLocations($query)
    {
        return $query->where('type', self::TYPE_RELATED_ENTITIES_LOCATION);
    }

    public function scopeRelatedEntitiesPeopleOrganization($query)
    {
        return $query->where('type', self::TYPE_RELATED_ENTITIES_PEOPLE_ORGANIZATION);
    }

    public function scopeBatchImagesUpload($query)
    {
        return $query->where('type', self::TYPE_BATCH_IMAGES_UPLOAD);
    }
}
