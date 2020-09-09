<?php

namespace App\Models;

use App\Notifications\ListingRequestCreated;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class ListingRequest extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'listing_requests';
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

    protected static function booted()
    {
        static::created(function ($model) {
            $emailToSettings = env('SEND_LISTING_REQUEST_CREATED_EMAIL');
            $emailToArray    = array_map('trim', explode(',', $emailToSettings));
            $notification    = new ListingRequestCreated($model);

            foreach ($emailToArray as $email) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Notification::route('mail', $email)->notify($notification);
                }
            }
        });
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
        return '<a class="btn btn-xs btn-default" href="'.route('listingrequest.getPublish', ['id' => $this->id]).'" data-toggle="tooltip" title="Accept listing request">Accept</a>';
    }

    public function generateDeclineButton()
    {
        return '<a class="btn btn-xs btn-default" href="'.route('listingrequest.getDecline', ['id' => $this->id]).'" data-toggle="tooltip" title="Decline listing request">Decline</a>';
    }
}
