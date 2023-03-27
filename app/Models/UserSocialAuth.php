<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserSocialAuth extends Model
{
    protected $table = 'user_social_auth';

    protected static $providers = [
        'facebook',
        'google',
        'linkedin',
        'twitter',
    ];

    public static function getProviders()
    {
        return self::$providers;
    }

    public static function isProviderAllowed($provider)
    {
        return in_array($provider, self::$providers);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
