<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS_NEW = 'New';
    const STATUS_PENDING = 'Pending';
    const STATUS_SENT = 'Sent';
    const STATUS_OPENED = 'Opened';
    const STATUS_FAILED = 'Failed';
    const STATUS_DECLINED = 'Declined';

    const STATUES = [
        self::STATUS_NEW,
        self::STATUS_PENDING,
        self::STATUS_SENT,
        self::STATUS_OPENED,
        self::STATUS_FAILED,
        self::STATUS_DECLINED
    ];

    protected $casts = [
        'response' => 'array'
    ];

    /* Scopes  */
    public function scopeNew($query) {
        return $query->where('status', self::STATUS_NEW);
    }

    public function scopePending($query) {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeSent($query) {
        return $query->where('status', self::STATUS_SENT);
    }

    public function scopeOpened($query) {
        return $query->where('status', self::STATUS_OPENED);
    }

    public function scopeFailed($query) {
        return $query->where('status', self::STATUS_FAILED);
    }

    /* Relationships */
    public function emailCampaign(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailJourney::class);
    }

    public function emailSequence(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailSequence::class);
    }

    public function emailTemplate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* Accessors */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_NEW => 'bg-warning-bright text-dark',
            self::STATUS_PENDING => 'bg-primary',
            self::STATUS_SENT => 'bg-success',
            self::STATUS_FAILED => 'bg-danger',
            self::STATUS_DECLINED => 'bg-body-secondary text-body-emphasis opacity-75',
            default => 'text-warning'
        };
    }

}
