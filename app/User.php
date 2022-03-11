<?php

namespace App;

use App\Models\Dashboard;
use App\Models\FollowList;
use App\Models\Person;
use App\Models\RaisedClaim;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\UserSocialAuth;
use App\Traits\CanFollow;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Yadahan\AuthenticationLog\AuthenticationLogable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use CrudTrait;
    use AuthenticationLogable;
    use CanFollow;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'member_url', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dashboard_widgets_order' => 'array',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            FollowList::create([
                'name' => 'Favorites',
                'slug' => 'favorites',
                'user_id' => $user->id,
            ]);
        });
    }

    public function getFullnameAttribute(): string
    {
        return $this->name.' '.$this->last_name;
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

    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function dashboards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Dashboard::class);
    }
}
