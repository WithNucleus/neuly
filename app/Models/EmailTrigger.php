<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTrigger extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    const STATUES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];

    CONST TRIGGER_USER_ONBOARDING_DETAILS = 'User Onboarding Details';
    CONST TRIGGER_RESEARCH_REQUEST = 'Research Request';
    CONST TRIGGER_NEW_LISTING_REQUEST = 'New Listing Request';
    CONST TRIGGER_API_REQUEST = 'API Request';
    CONST TRIGGER_ENTERPRISE_REQUEST = 'Enterprise Request';
    CONST TRIGGER_RECRUITING_CLINICAL_TRIALS_REQUEST = 'Recruiting Clinical Trials';
    CONST TRIGGER_CARE_REQUEST = 'Neuly Care Forms';
    CONST TRIGGER_EDU_REQUEST = 'Neuly EDU Forms';

    /* Relationships */
    public function autoResponse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class, 'auto_response_id');
    }

    public function emailJourney(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailJourney::class);
    }
}
