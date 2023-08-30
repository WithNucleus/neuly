<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportedEntity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
        'errors' => 'array'
    ];

    const STATUS_NEW = 'New';
    const STATUS_ACCEPTED = 'Accepted';
    const STATUS_DECLINED = 'Declined';

    const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_ACCEPTED,
        self::STATUS_DECLINED
    ];

    const ERROR_LEAD_SPONSOR = 'Lead sponsor';
    const ERROR_RESPONSIBLE_PARTY = 'Responsible party';

    const ERROR_TYPES = [
        self::ERROR_LEAD_SPONSOR,
        self::ERROR_RESPONSIBLE_PARTY
    ];

    public function importable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Accessors
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('Y-m-d H:i');
    }

    public function getFormattedUpdatedAtAttribute(): string
    {
        return Carbon::parse($this->updated_at)->format('Y-m-d H:i');
    }
}
