<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class JobApplication extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'job_applications';
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
    public function getApplicantName() {

        $user = User::find($this->user_id);

        return $user->name . ' ' . $user->last_name;

    }

    public function getApplicantEmail() {

        $user = User::find($this->user_id);

        return '<a href="mailto:' . $user->email . '">' . $user->email . '</a>';

    }

    public function getOrganizationLink() {

        $company = Company::find($this->company_id);

        return '<a href="' . route('company.show', $company->id) . '">' . $company->name . '</a>';
    }

    public function getJobLink() {

        $job = Job::find($this->job_id);

        return '<a href="' . route('job.show', $job->id) . '">' . $job->job_title . '</a>';
    }

    public function getCoverLetter() {

        return '<a href="' . route('jobsapp.coverletter', $this->id) . '" target="_blank" rel="noopener noreferrer">View File</a>';
    }

    public function getResume() {

        return '<a href="' . route('jobsapp.resume', $this->id) . '" target="_blank" rel="noopener noreferrer">View File</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\Job', 'job_id');
    }

    // Get the old slugs redirect records of the model
    public function redirects()
    {
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
