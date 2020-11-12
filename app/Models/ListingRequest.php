<?php

namespace App\Models;

use App\Helpers\NotificationHelper;
use App\Notifications\ListingRequestCreated;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ListingRequest extends Model
{
    use CrudTrait;

    const STATUS_OPEN = 'open';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'listing_requests';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::created(function ($model) {
            NotificationHelper::sendAdminNotifications(new ListingRequestCreated($model));
        });
    }

    public function scopeOpen($query)
    {
        return $query->where('status', self::STATUS_OPEN);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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

    public function generateAcceptButton()
    {
        return '<a class="btn btn-xs btn-default" href="'.route('listingrequest.getPublish', ['id' => $this->id]).'" data-toggle="tooltip" title="Review All Changes">Review All Changes</a>';
    }

    public function generateDeclineButton()
    {
        return '<a class="btn btn-xs btn-default" href="'.route('listingrequest.getDecline', ['id' => $this->id]).'" data-toggle="tooltip" title="Decline listing request">Decline</a>';
    }
}
