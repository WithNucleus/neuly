<?php

namespace App;

use App\Models\BookableListing;
use App\Models\BookableListingRequest;
use App\Models\Dashboard;
use App\Models\EduRequest;
use App\Models\EmailPreference;
use App\Models\EmailTrigger;
use App\Models\Feedback;
use App\Models\FollowList;
use App\Models\Notification;
use App\Models\Person;
use App\Models\RaisedClaim;
use App\Models\SearchLog;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\UserSocialAuth;
use App\Traits\CanFollow;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Yadahan\AuthenticationLog\AuthenticationLogable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use CrudTrait;
    use AuthenticationLogable;
    use CanFollow;
    use HasApiTokens;

    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'member_url', 'email_verified_at', 'registration_code', 'referred_by', 'interests'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dashboard_widgets_order' => 'array',
        'interests' => 'array'
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            FollowList::create([
                'name' => 'Favorites',
                'slug' => 'favorites',
                'user_id' => $user->id,
            ]);

            EmailPreference::updateOrCreate(
                ['email' => $user->email],
                [
                    'email' => $user->email,
                    'user_id' => $user->id,
                ]
            );
        });
    }

    const INTEREST_CARE = 'Care';
    const INTEREST_EDU = 'Education';
    const INTEREST_RESEARCH = 'Research';
    const INTEREST_ENTERPRISE = 'Enterprise';

    const INTERESTS = [
        self::INTEREST_CARE,
        self::INTEREST_EDU,
        self::INTEREST_RESEARCH,
        self::INTEREST_ENTERPRISE
    ];

    /* Relationships */
    public function bookableListings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BookableListing::class);
    }

    public function bookableListingRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BookableListingRequest::class);
    }

    public function socialAuth(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserSocialAuth::class);
    }

    public function relatedPerson(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Person::class, 'user_id');
    }

    public function raisedClaim(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RaisedClaim::class);
    }

    public function hasRaisedClaimBefore(): bool
    {
        return $this->raisedClaim()->exists();
    }

    public function teamInvitations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TeamInvitation::class);
    }

    public function ownedTeam(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Team::class, 'owner_id');
    }

    public function teams(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function dashboards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Dashboard::class);
    }

    public function eduRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EduRequest::class);
    }

    public function feedback(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function searchLogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SearchLog::class);
    }

    public function notifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function emailPreference(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(EmailPreference::class);
    }

    public function emailTriggers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(EmailTrigger::class, 'email_trigger_user')->withTimestamps();
    }

    /* Attributes */
    public function getFullnameAttribute(): string
    {
        return $this->name.' '.$this->last_name;
    }

    public function getPrettyCreatedAtAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('M d, Y H:i');
    }

    public function getDashboardLinkAttribute(): string
    {
        if($this->can('enterprise demo')) {
            return route('enterprise.dashboard');
        }

        return route('member.dashboard');
    }

    public function getNeedsOnboardingAttribute(): bool
    {
        if($this->last_name) {
            return false;
        }

        return true;
    }
}
