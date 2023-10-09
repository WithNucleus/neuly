<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSequence extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const DELAY_NONE = 'none';

    /* Relationships */
    public function emailCampaign(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailJourney::class);
    }

    public function emailTemplate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class);
    }

    /* Accessors */
    public function getNameAttribute() {
        return $this->emailTemplate->name;
    }
}
