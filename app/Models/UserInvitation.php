<?php

namespace App\Models;

use App\Jobs\EmailMarketing\CreateCampaignEmails;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserInvitation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::created(function ($model) {

            $mergeFields = [
                'button' => route('invitation.accept-user-invite', ['token' => $model->token])
            ];

            CreateCampaignEmails::dispatch(EmailTrigger::TRIGGER_USER_INVITED, $model->emailPreference->first_name, $model->email_preference_email, NULL, $mergeFields);
        });
    }

    /* Relationships */
    public function emailPreference(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailPreference::class);
    }

    public function emailJourney(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailJourney::class);
    }

    public function inviter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invitee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* Functions */
    public static function generateToken(): string
    {
        return Carbon::now()->timestamp . Str::random(50);
    }
}
