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

    /* Relationships */
    public function emails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function emailCampaigns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailCampaign::class);
    }

    public function emailDrips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailDrip::class);
    }
}
