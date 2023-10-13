<?php

namespace App\Models;

use App\Jobs\EmailMarketing\CreateAdminEmailsFromTrigger;
use App\Jobs\EmailMarketing\CreateCampaignEmails;
use App\Models\Contracts\CrmActionsContract;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\SlackAlerts\Facades\SlackAlert;

class CareRequest extends Model implements CrmActionsContract
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'data' => 'array'
    ];

    const TYPE_CLINICAL_TRIAL_PARTICIPANT = 'Clinical Trial Participant';
    const TYPE_PRACTITIONER_NO_MATCHES = 'Practitioner - No Matches';
    const TYPE_BOOKABLE_LISTING_RESERVATION = 'Bookable Listing Reservation';

    const TYPES = [
        self::TYPE_CLINICAL_TRIAL_PARTICIPANT,
        self::TYPE_PRACTITIONER_NO_MATCHES,
        self::TYPE_BOOKABLE_LISTING_RESERVATION
    ];

    const STATUS_OPEN = 'Open';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_AWAITING_RESPONSE = 'Awaiting Response';
    const STATUS_COMPLETED = 'Completed';

    const STATUSES = [
        self::STATUS_OPEN,
        self::STATUS_IN_PROGRESS,
        self::STATUS_AWAITING_RESPONSE,
        self::STATUS_COMPLETED
    ];

    protected static function booted()
    {
        static::created(function ($careRequest) {

            SlackAlert::to('default')->message('*NeulyCARE Request*' . "\n" .
                '*Type:* ' . $careRequest->type . "\n" .
                '*Name:* ' . $careRequest->name . "\n" .
                '*Email:* ' . $careRequest->email . "\n" .
                '*Phone:* ' . $careRequest->phone . "\n" .
                '*Message:*' . "\n" .
                "```". $careRequest->message . '```' . "\n" .
                '<' . route('adminx.care.care-requests', ['find' => $careRequest->id]) .'|View Request>'
            );

            $mergeFields = [];

            if ($careRequest->entity) {
                $mergeFields['entity_name'] = $careRequest->entity->name;
            }

            if ($careRequest->type === self::TYPE_CLINICAL_TRIAL_PARTICIPANT) {
                CreateCampaignEmails::dispatch(EmailTrigger::TRIGGER_RECRUITING_CLINICAL_TRIALS_REQUEST, $careRequest->name, $careRequest->email, $careRequest->user_id, $mergeFields);
                CreateAdminEmailsFromTrigger::dispatch(EmailTrigger::TRIGGER_RECRUITING_CLINICAL_TRIALS_REQUEST, ['url' => route('adminx.care.care-requests', ['find' => $careRequest->id])]);
            } else {
                CreateCampaignEmails::dispatch(EmailTrigger::TRIGGER_CARE_REQUEST, $careRequest->name, $careRequest->email, $careRequest->user_id, $mergeFields);
                CreateAdminEmailsFromTrigger::dispatch(EmailTrigger::TRIGGER_CARE_REQUEST, ['url' => route('adminx.care.care-requests', ['find' => $careRequest->id])]);
            }
        });
    }

    /* Accessors */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_OPEN => 'bg-danger',
            self::STATUS_COMPLETED => 'bg-body-secondary text-body-emphasis opacity-50',
            self::STATUS_AWAITING_RESPONSE => 'bg-warning text-body-emphasis',
            self::STATUS_IN_PROGRESS => 'bg-warning-bright text-body-emphasis',
            default => 'text-warning'
        };
    }

    public function getEntityLinkAttribute(): ?string
    {
        if ($this->entity_type === Research::class) {
            return route('discover.research.show', $this->entity->slug);
        }

        return null;
    }

    /* Relationships */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function entity(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    #[ArrayShape([self::STATUS_COMPLETED => "string[]", self::STATUS_AWAITING_RESPONSE => "string[]", self::STATUS_IN_PROGRESS => "string[]", self::STATUS_OPEN => "string[]"])] public static function crmActionItems(): array
    {
        return [
            self::STATUS_COMPLETED => [
                'label' => 'Mark completed',
                'button' => 'accent'
            ],
            self::STATUS_AWAITING_RESPONSE => [
                'label' => 'Needs response',
                'button' => 'warning'
            ],
            self::STATUS_IN_PROGRESS => [
                'label' => 'In progress',
                'button' => 'warning-bright'
            ],
            self::STATUS_OPEN => [
                'label' => 'Re-open',
                'button' => 'primary'
            ]
        ];
    }
}
