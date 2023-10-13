<?php

namespace App\Models;

use App\Helpers\NotificationHelper;
use App\Jobs\EmailMarketing\CreateAdminEmailsFromTrigger;
use App\Jobs\EmailMarketing\CreateCampaignEmails;
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

    protected $casts = ['entity_data' => 'object'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::created(function ($model) {
//            NotificationHelper::sendAdminNotifications(new ListingRequestCreated($model));
            CreateCampaignEmails::dispatch(EmailTrigger::TRIGGER_NEW_LISTING_REQUEST, $model->name, $model->email, $model->user_id);
            CreateAdminEmailsFromTrigger::dispatch(EmailTrigger::TRIGGER_NEW_LISTING_REQUEST, ['url' => route('admin.listingrequest.show', $model->id)]);
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
        return '<a class="btn btn-xs btn-default" href="'.route('admin.listingrequest.accept', ['id' => $this->id]).'" data-toggle="tooltip" title="Review All Changes">Review All Changes</a>';
    }

    public function generateDeclineButton()
    {
        return '<a class="btn btn-xs btn-default" href="'.route('admin.listingrequest.decline', ['id' => $this->id]).'" data-toggle="tooltip" title="Decline listing request">Decline</a>';
    }
}
