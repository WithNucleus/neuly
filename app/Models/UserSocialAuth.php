<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserSocialAuth extends Model
{
    protected $table = 'user_social_auth';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
