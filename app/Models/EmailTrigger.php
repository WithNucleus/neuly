<?php

namespace App\Models;

use App\User;
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

    const TRIGGER_USER_ONBOARDING_DETAILS = 'User Onboarding Details';
    const TRIGGER_RESEARCH_REQUEST = 'Research Request';
    const TRIGGER_NEW_LISTING_REQUEST = 'New Listing Request';
    const TRIGGER_API_REQUEST = 'API Request';
    const TRIGGER_ENTERPRISE_REQUEST = 'Enterprise Request';
    const TRIGGER_RECRUITING_CLINICAL_TRIALS_REQUEST = 'Recruiting Clinical Trials';
    const TRIGGER_CARE_REQUEST = 'Neuly Care Forms';
    const TRIGGER_EDU_REQUEST = 'Neuly EDU Forms';
    const TRIGGER_CRM_ASSIGNED = 'Task Assigned';
    const TRIGGER_CRM_FOLLOW_UP = 'Follow-Up Needed';

    /* Scopes  */
    public function scopeActive($query) {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /* Relationships */
    public function adminResponse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class, 'admin_response_id');
    }

    public function adminUsers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'email_trigger_user')->withTimestamps();
    }

    public function autoResponse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class, 'auto_response_id');
    }

    public function emailJourney(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailJourney::class);
    }

    public function emails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function partnerResponse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class, 'partner_response_id');
    }
}
