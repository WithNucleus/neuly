<?php

namespace App\Models;

use App\Models\Contracts\CrmActionsContract;
use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;

class Feedback extends Model implements CrmActionsContract
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

    const TYPE_NICE_NAMES = [
        self::TYPE_FEEDBACK =>'General Feedback',
        self::TYPE_FEATURE => 'Feature Request',
        self::TYPE_DEMO_REQUEST => 'Demo Request',
        self::TYPE_ENTERPRISE_REQUEST => 'Enterprise Request',
        self::TYPE_BUG => 'Bug / Problem',
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

    protected $casts = [
        'data' => 'array'
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
    #[ArrayShape([self::STATUS_CLOSED => "string[]", self::STATUS_AWAITING_RESPONSE => "string[]", self::STATUS_IN_PROGRESS => "string[]", self::STATUS_OPEN => "string[]"])] public static function crmActionItems(): array
    {
        return [
            Feedback::STATUS_CLOSED => [
                'label' => 'Mark completed',
                'button' => 'accent'
            ],
            Feedback::STATUS_AWAITING_RESPONSE => [
                'label' => 'Needs response',
                'button' => 'warning'
            ],
            Feedback::STATUS_IN_PROGRESS => [
                'label' => 'In progress',
                'button' => 'warning-bright'
            ],
            Feedback::STATUS_OPEN => [
                'label' => 'Re-open',
                'button' => 'primary'
            ]
        ];
    }

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
