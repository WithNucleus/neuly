<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailPreference extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $guarded = [];
    protected $primaryKey = 'email';

    protected $casts = [
        'marketing' => 'boolean',
        'do_not_email' => 'boolean',
    ];

    /* Scopes */
    public function scopeBlacklist($query) {
        return $query->where('do_not_email', true);
    }

    public function scopeUnregistered($query) {
        return $query->whereNull('user_id');
    }

    /* Relationships */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function emails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Email::class);
    }

    /* Accessors */
    public function getIdAttribute() {
        return $this->email;
    }

    public function getFullNameAttribute(): ?string
    {
        if ($this->first_name AND $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        }

        return $this->first_name ?? NULL;
    }

    public function getMarketingIconAttribute(): string
    {
        if ($this->marketing === true) {
            return 'fa-solid fa-cloud-check text-primary';
        } else {
            return 'fa-sharp fa-solid fa-subtitles-slash text-danger';
        }
    }

    public function getBlacklistIconAttribute(): string
    {
        if ($this->do_not_email === true) {
            return 'fa-sharp fa-solid fa-siren-on text-danger';
        } else {
            return 'fa-solid fa-check text-body-secondary';
        }
    }

    public function getMarketingLabelAttribute(): string
    {
        if ($this->marketing === true) {
            return 'Marketing emails';
        } else {
            return 'Opted out';
        }
    }

    public function getBlacklistLabelAttribute(): ?string
    {
        if ($this->do_not_email === true) {
            return 'Do not email!';
        } else {
            return NULL;
        }
    }
}
