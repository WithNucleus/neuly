<?php

namespace App;

use App\Traits\canFollow;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Yadahan\AuthenticationLog\AuthenticationLogable;
use Spatie\Permission\Traits\HasRoles;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Models\BookmarkList;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use CrudTrait;
    use AuthenticationLogable;
    use canFollow;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'member_url'
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
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            // Create a Bookmark List
            $bookmark_list = BookmarkList::create([
                'name' => 'Favorites',
                'slug' => 'favorites',
                'user_id' => $user->id
            ]);
        });
    }
}
