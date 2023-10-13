<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    const STATUES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];

    const TYPE_USER = 'User';
    const TYPE_ADMIN = 'Admin';
    const TYPE_PARTNER = 'Partner';

    const TYPES = [
        self::TYPE_USER,
        self::TYPE_ADMIN,
        self::TYPE_PARTNER
    ];

    /* Scopes  */
    public function scopeActive($query) {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /* Relationships */
    public function emails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function emailSequences(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailSequence::class);
    }

    public function emailTriggers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailTrigger::class, 'auto_response_id');
    }
}
