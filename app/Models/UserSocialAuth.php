<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserSocialAuth extends Model
{
    protected $table = 'user_social_auth';

    const PROVIDER_FACEBOOK = 'facebook';
    const PROVIDER_GOOGLE = 'google';
    const PROVIDER_LINKEDIN = 'linkedin';
    const PROVIDER_TWITTER = 'twitter'; // no new logins, only old

    protected static array $providers = [
        self::PROVIDER_FACEBOOK,
        self::PROVIDER_GOOGLE,
        self::PROVIDER_LINKEDIN
    ];

    public static function getProviders(): array
    {
        return self::$providers;
    }

    public static function isProviderAllowed($provider): bool
    {
        return in_array($provider, self::$providers);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getIconAttribute(): string
    {
        return match($this->provider_name) {
            self::PROVIDER_FACEBOOK => 'fa-brands fa-facebook text-facebook',
            self::PROVIDER_GOOGLE => 'fa-brands fa-google text-google',
            self::PROVIDER_LINKEDIN => 'fa-brands fa-linkedin-in text-linkedin',
            self::PROVIDER_TWITTER => 'fa-brands fa-twitter text-twitter',
            default => 'fa-sharp fa-solid fa-question'
        };
    }

    public function getProviderNiceNameAttribute(): string
    {
        return match($this->provider_name) {
            self::PROVIDER_FACEBOOK => 'Facebook',
            self::PROVIDER_GOOGLE => 'Google',
            self::PROVIDER_LINKEDIN => 'LinkedIn',
            self::PROVIDER_TWITTER => 'Twitter',
            default => $this->provider_name
        };
    }
}
