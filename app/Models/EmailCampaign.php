<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    const STATUES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];

    const TYPE_REGULAR = 'Regular';
    const TYPE_DRIP = 'Drip';

    const TRIGGER_ONBOARDING_USER_DETAILS_COMPLETE = 'Onboarding User Details Complete';
    const TRIGGER_ENTERPRISE_RESEARCH_REQUEST = 'Enterprise Research Request';

    /* Relationships */
    public function emails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function emailDrips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailDrip::class)->orderBy('order');
    }

    public function emailTemplates(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class);
    }
}
