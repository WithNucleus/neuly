<?php

namespace App\Models;

use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Job extends Model
{
    use CrudTrait;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

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
    ];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function generateUniqueSlug($name)
    {
        $slug      = Str::slug($name);
        $slugCount = Person::where('slug', $slug)->count();

        if ($slugCount > 0) {
            $slug = $slug . '-' . uniqid();
        }

        return $slug;
    }

    public function getShowLink() {
        return '<a href="' . route('discover.jobs.show', $this->slug) . '">' . $this->job_title . '</a>';
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

    public function setJobTitleAttribute($value)
    {
        $this->attributes['job_title'] = $value;
        $this->attributes['slug'] = self::generateUniqueSlug($value);
    }
}
