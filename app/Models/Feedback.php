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

    const TYPE_FEEDBACK = 'feedback';

    const TYPE_PROBLEM = 'problem';

    const TYPE_BUG = 'bug';

    const TYPE_SUGGESTION = 'suggestion';

    const TYPE_FEATURE = 'feature request';

    const TYPE_DEMO_REQUEST = 'demo request';

    const TYPE_ENTERPRISE_REQUEST = 'enterprise request';

    const TYPE_CT_PARTICIPATING = 'clinical trial participating';

    const TYPES = [
        self::TYPE_FEEDBACK,
        self::TYPE_PROBLEM,
        self::TYPE_BUG,
        self::TYPE_SUGGESTION,
        self::TYPE_FEATURE,
        self::TYPE_DEMO_REQUEST,
        self::TYPE_ENTERPRISE_REQUEST,
        self::TYPE_CT_PARTICIPATING,
    ];
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
