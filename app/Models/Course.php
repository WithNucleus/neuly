<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Jobs\AutoTag\TagCourse;
use App\Models\Traits\EntityImage;
use App\Models\Traits\SearchableEntity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use CrudTrait,
        SearchableEntity,
        LogsActivity,
        EntityImage;

    const CURRENCY_USD = 'USD';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'courses';

    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    protected static $imageAttribute = 'image';
    protected static $imageFolderPath = 'courses';
    protected static $imageFilenameAttribute = 'name';

    const TYPE_ONLINE = 'Online';
    const TYPE_OFFLINE = 'In-Person';
    const TYPE_HYBRID = 'Hybrid';

    const TYPES = [
        self::TYPE_ONLINE,
        self::TYPE_OFFLINE,
        self::TYPE_HYBRID
    ];

    const SCHEDULE_RECURRING = 'Recurring';
    const SCHEDULE_UPCOMING = 'Upcoming';
    const SCHEDULE_PAST = 'Past';

    const SCHEDULE = [
        self::SCHEDULE_RECURRING,
        self::SCHEDULE_UPCOMING,
        self::SCHEDULE_PAST
    ];

    const EDUCATION_CREDIT_CE = 'CE';
    const EDUCATION_CREDIT_CEU = 'CEU';
    const EDUCATION_CREDIT_CPD = 'CPD';
    const EDUCATION_CREDIT_CME = 'CME';
    const EDUCATION_CREDIT_CPE = 'CPE';
    const EDUCATION_CREDIT_ECTP = 'ECTP';

    const EDUCATION_CREDITS = [
        self::EDUCATION_CREDIT_CE,
        self::EDUCATION_CREDIT_CEU,
        self::EDUCATION_CREDIT_CPD,
        self::EDUCATION_CREDIT_CME,
        self::EDUCATION_CREDIT_CPE,
        self::EDUCATION_CREDIT_ECTP
    ];

    private $searchableRelationships = [
        'focus' => 'name',
        'companies' => 'name',
    ];

    private $searchableSkippedFields = [];

    private $searchableModelName = 'Course';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function booted()
    {
        static::created(function ($course) {
            TagCourse::dispatch($course);
        });

        static::updated(function ($course) {
            TagCourse::dispatch($course);
        });
    }

    public static function getTypes(): array
    {
        return array_combine(self::TYPES, self::TYPES);
    }

    public static function getSchedules(): array
    {
        return array_combine(self::SCHEDULE, self::SCHEDULE);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function focus(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Focus::class);
    }

    public function eduRequests(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(EduRequest::class, 'entity');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeFree($query)
    {
        return $query->where('lowest_cost', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getFormattedSummaryAttribute(): string
    {
        return nl2br(e($this->summary));
    }

    public function getVeryShortSummaryAttribute(): ?string
    {
        return Str::words($this->summary, 15) ?? null;
    }

    public function getShortSummaryAttribute(): ?string
    {
        return Str::words($this->summary, 40) ?? null;
    }

    public function getFormattedCostAttribute(): ?string
    {
        $lowestCost = $this->lowest_cost;
        $highestCost = $this->highest_cost;

        if ($lowestCost == '') {
            return null;
        }

        $cost = null;

        if ($lowestCost === 0 and $highestCost == '') {
            $cost = 'Free';
        } else {
            $cost = '$'.number_format($lowestCost);

            if ($highestCost != '') {
                $cost .= '+';
            }
        }

        return $cost;
    }

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

    public function setImageAttribute($value)
    {
        $this->updateImageAttribute($value);
    }

    /**
     * @return array
     */
    public static function getFieldsMapping()
    {
        return [
            //attributes
            'name' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'slug' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'summary' => [
                'type' => FieldsMapping::TYPE_TEXT,
            ],
            'url' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'type' => [
                'type' => FieldsMapping::TYPE_ENUM,
                'values' => self::getTypes(),
            ],
            'lowest_cost' => [
                'type' => FieldsMapping::TYPE_INTEGER,
            ],
            'highest_cost' => [
                'type' => FieldsMapping::TYPE_INTEGER,
            ],
            'schedule' => [
                'type' => FieldsMapping::TYPE_ENUM,
                'values' => self::getSchedules(),
            ],
            'education_credits' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'next_date' => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            //relations
            'companies' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'focus' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(self::$logName);
    }
}
