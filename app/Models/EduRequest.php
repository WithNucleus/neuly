<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EduRequest extends Model
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

    const STATUS_NEW = 'New';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_AWAITING_RESPONSE = 'Awaiting Response';
    const STATUS_COMPLETED = 'Completed';

    const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_IN_PROGRESS,
        self::STATUS_AWAITING_RESPONSE,
        self::STATUS_COMPLETED
    ];

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
            self::STATUS_NEW => 'bg-danger',
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
}
