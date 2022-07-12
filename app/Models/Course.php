<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Models\Traits\SearchableEntity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use CrudTrait;
    use SearchableEntity;
    use LogsActivity;

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

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeFree($query) {
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

    public function getFormattedCostAttribute(): string
    {
        $lowestCost = $this->lowest_cost;
        $highestCost = $this->highest_cost;

        $cost = '';

        if ($lowestCost === 0 AND $highestCost == '') {
            $cost = 'Free';
        } else {
            $cost = '$' . number_format($lowestCost);

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

    /**
     * @return array
     */
    public static function getFieldsMapping()
    {
        return [
            //attributes
            'name'                   => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'slug'                    => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'summary'              => [
                'type'  => FieldsMapping::TYPE_TEXT,
            ],
            'url'                 => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'type'                  => [
                'type' => FieldsMapping::TYPE_ENUM,
                'values' => self::getTypes(),
            ],
            'lowest_cost'           => [
                'type' => FieldsMapping::TYPE_INTEGER,
            ],
            'highest_cost'                  => [
                'type' => FieldsMapping::TYPE_INTEGER,
            ],
            'schedule'                     => [
                'type' => FieldsMapping::TYPE_ENUM,
                'values' => self::getSchedules(),
            ],
            'education_credits'                  => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'next_date'              => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            //relations
            'companies'               => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'focus'                   => [
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
