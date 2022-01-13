<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use CrudTrait;

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
}
