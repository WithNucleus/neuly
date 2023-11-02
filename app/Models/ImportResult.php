<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ImportResult extends Model
{
    const TYPE_CLINICAL_TRIALS = 'clinical_trials';
    const TYPE_RELATED_ENTITIES_LOCATION = 'related_entities_locations';
    const TYPE_RELATED_ENTITIES_PEOPLE_ORGANIZATION = 'related_entities_people_organisation';
    const TYPE_BATCH_IMAGES_UPLOAD = 'batch_images_upload';
    const TYPE_COURSES_WITH_RELATIONSHIPS = 'Courses with Relationships';
    const TYPE_USER_INVITES = 'User Invites';

    const STATUS_SUCCESS = 'Success';
    const STATUS_SUCCESS_WITH_ERRORS = 'Success with Errors';
    const STATUS_FAILED = 'Failed';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'import_results';

    protected $guarded = ['id'];

    protected $casts = [
        'options' => 'array',
        'data' => 'array',
        'errors' => 'array',
        'location_messages' => 'array',
        'people_messages' => 'array',
        'company_messages' => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function focus()
    {
        return $this->belongsTo(\App\Models\Focus::class);
    }

    public function failures()
    {
        return $this->hasMany(\App\Models\ImportFailure::class, 'import_result_id', 'id');
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

    public function scopeUsers($query)
    {
        return $query->where('type', self::TYPE_USER_INVITES);
    }

    /**
     * Accessors
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('Y-m-d H:i');
    }

    public function getFormattedUpdatedAtAttribute(): string
    {
        return Carbon::parse($this->updated_at)->format('Y-m-d H:i');
    }
}
