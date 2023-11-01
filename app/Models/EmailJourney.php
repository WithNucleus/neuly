<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailJourney extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    const STATUES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];

    const JOURNEY_INVITED_USERS = 'Invited User';

    const JOURNEYS_WITH_AUTOMATION = [
        self::JOURNEY_INVITED_USERS
    ];

    /* Relationships */
    public function emails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function emailSequences(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailSequence::class)->orderBy('order');
    }

    public function emailTriggers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailTrigger::class);
    }
}
