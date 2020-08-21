<?php

namespace App\Models;

use App\Models\Traits\OldSlugRedirectable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Job extends Model
{
    use CrudTrait;
    use OldSlugRedirectable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'jobs';
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

    // Each Job Belongs to One Company
    public function company() {
        return $this->belongsTo('App\Models\Company');
    }

    // Each Job Can Have Many Focus Categories
    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'focus_job', 'job_id', 'focus_id')
                    ->withTimestamps();
    }

    // Each Job Can Have Multiple Locations
    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'job_location', 'job_id', 'location_id')
                    ->withTimestamps();
    }

    // Each Job Can Have Multiple Job Applications
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
}
