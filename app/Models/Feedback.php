<?php

namespace App\Models;

use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use CrudTrait;

    const TYPE_FEEDBACK = 'feedback';
    const TYPE_PROBLEM = 'problem';
    const TYPE_BUG = 'bug';
    const TYPE_SUGGESTION = 'suggestion';
    const TYPE_FEATURE = 'feature request';
    const TYPE_DEMO_REQUEST = 'demo request';
    const TYPE_ENTERPRISE_REQUEST = 'enterprise request';
    const TYPE_CT_PARTICIPATING = 'clinical trial participating';

    const TYPES = [
        self::TYPE_FEEDBACK,
        self::TYPE_PROBLEM,
        self::TYPE_BUG,
        self::TYPE_SUGGESTION,
        self::TYPE_FEATURE,
        self::TYPE_DEMO_REQUEST,
        self::TYPE_ENTERPRISE_REQUEST,
        self::TYPE_CT_PARTICIPATING
    ];

    const STATUS_OPEN = 'open';
    const STATUS_CLOSED = 'closed';
    const STATUS_AWAITING_RESPONSE = 'awaiting response';
    const STATUS_IN_PROGRESS = 'in progress';

    const STATUSES = [
        self::STATUS_OPEN,
        self::STATUS_CLOSED,
        self::STATUS_AWAITING_RESPONSE,
        self::STATUS_IN_PROGRESS
    ];

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'feedback';

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getTypeAttribute($value): string
    {
        return ucfirst($value);
    }

    public function getUserNameAttribute($value): ?string
    {
        return ($this->user !== null) ? $this->user->name : $value;
    }

    public function getUserEmailAttribute($value): ?string
    {
        return ($this->user !== null) ? $this->user->email : $value;
    }

    public function getAssigneeNameAttribute(): string
    {
        return ($this->assignee !== null) ? $this->assignee->name : 'Unassigned';
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_OPEN => 'bg-danger',
            self::STATUS_CLOSED => 'bg-body-secondary text-body-emphasis opacity-50',
            self::STATUS_AWAITING_RESPONSE => 'bg-warning text-body-emphasis',
            self::STATUS_IN_PROGRESS => 'bg-warning-bright text-body-emphasis',
            default => 'text-warning'
        };
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
