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
        return '<a href="mailto:' . $this->user->email . '">' . $this->user->email . '</a>';
    }

    public function getOwnerName() {
        return $this->job->owner->name;
    }

    public function getOwnerLink() {
        return '<a href="' . $this->job->ownerShowUrlAdmin . '">' . $this->job->owner->name . '</a>';
    }

    public function getJobLink() {
        return '<a href="' . route('job.show', $this->job->id) . '">' . $this->job->job_title . '</a>';
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
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
