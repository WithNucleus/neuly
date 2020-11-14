<?php

namespace App\Helpers;

use App\Model\UserSocialAuth;
use Illuminate\Http\Request;

class ClaimPersonHelper
{
    public static function checkForIdenticalEmails($user, $person)
    {
        return $user->email === $person->email || $user->email === $person->secondary_email;
    }

    public static function checkUsersSocialLogins($socials, $user)
    {
        $logins = UserSocialAuth::whereIn('provider_name', $socials)
            ->where('user_id', '=', $user->id)
            ->get();

        return (bool) count($logins);
    }

    public static function canBeClaimedViaSocial($socials, $user, $person)
    {
        return ClaimPersonHelper::checkForIdenticalEmails($user, $person) && ClaimPersonHelper::checkUsersSocialLogins($socials, $user);
    }
}
