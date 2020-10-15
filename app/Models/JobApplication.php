<?php

namespace App\Models;

use App\Helpers\NotificationHelper;
use App\Models\Traits\OldSlugRedirectable;
use App\Notifications\JobApplicationCreated;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\User;

class JobApplication extends Model
{
    use CrudTrait;
    use OldSlugRedirectable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'job_applications';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function booted()
    {
        static::created(function ($model) {
            NotificationHelper::sendAdminNotifications(new JobApplicationCreated($model));
        });
    }

    public function getApplicantNameAttribute()
    {
        return $this->user->name . ' ' . $this->user->last_name;
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
