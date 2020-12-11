<?php

namespace App\Helpers;

use App\Models\Person;
use App\Models\RaisedClaim;
use App\Models\UserSocialAuth;
use App\User;

class ClaimPersonHelper
{
    /**
     * @param \App\User $user
     * @param \App\Models\Person $person
     * @return bool
     */
    public static function checkByEmail(User $user, Person $person)
    {
        $emails = $person->getEmails();

        if ($emails === []) {
            return false;
        }

        return $user->hasVerifiedEmail() && in_array($user->email, $emails);
    }

    /**
     * @param \App\User $user
     * @param \App\Models\Person $person
     * @return false
     */
    public static function checkBySocials(User $user, Person $person)
    {
        $socials = $person->getSocialProfiles();
        $emails = $person->getEmails();

        if ($socials === [] || $emails === []) {
            return false;
        }

        return UserSocialAuth::whereIn('provider_name', $socials)
            ->whereIn('email', $emails)
            ->where('user_id', '=', $user->id)
            ->exists();
    }

    /**
     * @param \App\User $user
     * @param \App\Models\Person $person
     * @return bool
     */
    public static function canBeAutoClaimed(User $user, Person $person)
    {
        return self::checkByEmail($user, $person) || self::checkBySocials($user, $person);
    }

    /**
     * @param \App\User $user
     * @param \App\Models\Person $person
     * @param \App\Models\RaisedClaim|null $claim
     */
    public static function acceptClaim(User $user, Person $person, RaisedClaim $claim = null)
    {
        $person->user_id = $user->id;
        $person->save();
        $user->person_id = $person->id;
        $user->save();

        if ($claim) {
            $claim->verification_token = null;
            $claim->save();
        }
    }
}
