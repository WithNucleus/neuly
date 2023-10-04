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

    /* Relationships */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
