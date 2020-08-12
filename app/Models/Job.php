<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'jobs';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

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

    // Get the old slugs redirect records of the model
    public function redirects() {
        return $this->morphMany('App\Models\Redirect', 'redirectable');
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
