<?php

namespace App\Models;

use App\Helpers\NotificationHelper;
use App\Notifications\FeedbackCreated;
use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'feedback';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

//    protected static function booted()
//    {
//        static::created(function ($model) {
//            NotificationHelper::sendAdminNotifications(new FeedbackCreated($model));
//        });
//    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    public function getTypeAttribute($value)
    {
        return ucfirst($value);
    }

    public function getUserNameAttribute($value)
    {
        return ($this->user !== null) ? $this->user->name : $value;
    }

    public function getUserEmailAttribute($value)
    {
        return ($this->user !== null) ? $this->user->email : $value;
    }

    public function getAssigneeNameAttribute()
    {
        return ($this->assignee !== null) ? $this->assignee->name : 'Unassigned';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
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
