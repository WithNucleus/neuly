<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Models\Traits\SearchableEntity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Job extends Model implements EntityContract
{
    use CrudTrait;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;
    use SearchableEntity;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const EMPLOYMENT_TYPE = [
        'Full Time',
        'Part Time',
        'One Time',
    ];

    const STATUS_OPEN = 'open';
    const STATUS_ARCHIVED = 'archived';

    protected $table = 'jobs';
    protected $guarded = ['id'];
    protected $fillable = [
        'job_title',
        'slug',
        'owner_id',
        'owner_type',
        'job_description',
        'employment_type',
        'posted_date',
        'salary',
        'hourly_rate',
        'status'
    ];

    protected $casts = [
        'posted_date' => 'date',
    ];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    private $searchableRelationships = [
        'locations' => 'name',
        'focus' => 'name',
    ];

    private $searchableMorphs = [
        'owner' => 'name'
    ];

    private $searchableDateFields = [
        'posted_date'
    ];

    private $searchableRenamedFields = [
        'job_title' => 'name'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $slugCount = self::where('slug', $slug)->count();

        if ($slugCount > 0) {
            $slug = $slug . '-' . uniqid();
        }

        return $slug;
    }

    public function getShowLink() {
        return '<a href="' . route('discover.jobs.show', $this->slug) . '">' . $this->job_title . '</a>';
    }

    /**
     * @return array
     */
    public static function getEmploymentTypeValues()
    {
        return array_combine(self::EMPLOYMENT_TYPE, self::EMPLOYMENT_TYPE);
    }

    /**
     * @return string|null
     */
    public function getOwnerShowUrlAdminAttribute()
    {
        if ($this->owner instanceof Company) {
            return route('company.show', $this->owner->id);
        }

        if ($this->owner instanceof Investor) {
            return route('investor.show', $this->owner->id);
        }

        return null;
    }

    public function getOwnerShowUrlAttribute()
    {
        if ($this->owner instanceof Company) {
            return route('discover.organizations.show', $this->owner->slug);
        }

        if ($this->owner instanceof Investor) {
            return route('discover.investors.show', $this->owner->slug);
        }

        return null;
    }

    /**
     * @return array
     */
    public static function getStatusValues()
    {
        return [
            self::STATUS_OPEN => 'Open',
            self::STATUS_ARCHIVED => 'Archived',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function owner()
    {
        return $this->morphTo();
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'owner_id')
            ->where('owner_type', Company::class);
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'owner_id')
            ->where('owner_type', Investor::class);
    }

    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'focus_job', 'job_id', 'focus_id')
                    ->withTimestamps();
    }

    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'job_location', 'job_id', 'location_id')
                    ->withTimestamps();
    }

    public function jobApplications() {
        return $this->hasMany('App\Models\JobApplication');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeOpen($query) {
        return $query->where('status', self::STATUS_OPEN);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getNameAttribute()
    {
        return $this->job_title;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setJobTitleAttribute($value)
    {
        $this->attributes['job_title'] = $value;
        $this->attributes['slug'] = self::generateUniqueSlug($value);
    }

    /**
     * @return array
     */
    public static function getFieldsMapping()
    {
        return [
            //this relation should be first in the fields order
            'owner'    => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_ONE_ONE_MORPHABLE,
                'relationMorphableTypes' => [
                    Company::class,
                    Investor::class,
                ],
                'morphableFieldId' => 'owner_id',
                'morphableFieldType' => 'owner_type',
                'relationField' => 'name',
            ],
            //attributes
            'job_title'      => [
                'type' => FieldsMapping::TYPE_STRING,
                'label' => 'Job Title',
                'required' => true,
            ],
            'slug'      => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'job_description'   => [
                'type' => FieldsMapping::TYPE_TEXT_EDITOR,
                'label' => 'Job Description',
            ],
            'employment_type'      => [
                'type' => FieldsMapping::TYPE_ENUM,
                'label' => 'Type',
                'values' => self::getEmploymentTypeValues(),
            ],
            'posted_date'      => [
                'type' => FieldsMapping::TYPE_DATE,
                'label' => 'Posted date',
            ],
            'salary'      => [
                'type' => FieldsMapping::TYPE_INTEGER,
            ],
            'hourly_rate'      => [
                'type' => FieldsMapping::TYPE_INTEGER,
                'label' => 'Hourly Rate',
            ],
            //relations
            'locations' => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'focus'     => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
        ];
    }

    public static function getListingRequestMapping()
    {
        $mapping = self::getFieldsMapping();
        $skipFields = ['slug'];

        foreach ($skipFields as $field) {
            unset($mapping[$field]);
        }

        return $mapping;
    }
}
