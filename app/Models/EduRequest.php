<?php

namespace App\Models;

use App\Models\Contracts\CrmActionsContract;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\SlackAlerts\Facades\SlackAlert;

class EduRequest extends Model implements CrmActionsContract
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'data' => 'array'
    ];

    const TYPE_COURSE_CONCIERGE = 'Course - Concierge';
    const TYPE_COURSE_NO_MATCHES = 'Course - No Matches';
    const TYPE_COURSE_REQUEST = 'Course - Request';

    const TYPES = [
        self::TYPE_COURSE_CONCIERGE,
        self::TYPE_COURSE_NO_MATCHES,
        self::TYPE_COURSE_REQUEST
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
        static::created(function ($eduRequest) {
            SlackAlert::to('default')->message('*NeulyEDU Request*' . "\n" .
                '*Type:* ' . $eduRequest->type . "\n" .
                '*Name:* ' . $eduRequest->name . "\n" .
                '*Email:* ' . $eduRequest->email . "\n" .
                '*Phone:* ' . $eduRequest->phone . "\n" .
                '*Message:*' . "\n" .
                '```' . $eduRequest->message . '```' . "\n" .
                '<' . route('adminx.edu.students') .'|View Request>'
            );
        });
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
        if ($this->entity_type === Course::class) {
            return route('discover.courses.show', $this->entity->slug);
        }

        return null;
    }

    /* Functions */
    #[ArrayShape([self::STATUS_COMPLETED => "string[]", self::STATUS_AWAITING_RESPONSE => "string[]", self::STATUS_IN_PROGRESS => "string[]", self::STATUS_OPEN => "string[]"])] public static function crmActionItems(): array {
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
