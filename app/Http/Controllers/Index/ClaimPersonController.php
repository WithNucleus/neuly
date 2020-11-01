<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Model\UserSocialAuth;
use App\Models\Person;
use App\Models\RaisedClaim;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimPersonController extends Controller
{
    public function claim(Request $request, $slug)
    {
        $user = Auth::user();
        $person = Person::where('slug', '=', $slug)->firstOrFail();

        if($this->hasUserRaisedAClaimBefore($user))
        {
            $request->session()->flash('error', 'You can only raise one claim at the same time.');

            return redirect()->route('discover.people.show', ['slug' => $person->slug]);
        }

        $socials = $this->getPersonSocialProfiles($person);


        //ToDo: this isn't 100% secure yet and needs some additional polish
        if($this->canBeClaimedViaSocial($socials, $user, $person))
        {
            $user->person_id = $person->id;
            $user->save();
            $person->user_id = $user->id;
            $person->save();

            $request->session()->flash('success', 'Your claim was successfully granted.');

            return redirect()->route('user.person.index');
        }

        $claim = new RaisedClaim();
        $claim->user_id = $user->id;
        $claim->person_id = $person->id;
        $claim->verification_token = sha1(time());
        $claim->save();

        $request->session()->flash('success', 'Your claim was raised.');

        return redirect()->route('discover.people.show', ['slug' => $person->slug]);

    }

    public function verifyClaim(Request $request, $slug, $token)
    {
        $person = Person::where('slug', '=', $slug)->firstOrFail();

        $claim = RaisedClaim::where('person_id', '=', $person->id)
                    ->where('verification_token', '=', $token)
                    ->firstOrFail();

        $user = User::findOrFail($claim->user_id);

        if($this->hasPersonMultipleClaimRaises($person))
        {
            $request->session()->flash('error', 'There has been a problem with your claim. Please contact us at support@neuly.com.');

            return redirect()->route('member.dashboard');
        }

        $person->user_id = $claim->user_id;
        $person->save();
        $user->person_id = $claim->person_id;
        $user->save();

        $claim->verification_token = null;
        $claim->save();

        $request->session()->flash('success', 'Your claim was successfully granted.');

        return redirect()->route('member.dashboard');
    }

    public function verifyClaimBySocial(Request $request, RaisedClaim $claim)
    {
        $person = Person::find($claim->person_id);
        $user = User::find($claim->user_id);

        if($this->hasPersonMultipleClaimRaises($person))
        {
            $request->session()->flash('error', 'There has been a problem with your claim. Please contact us at support@neuly.com.');

            return redirect()->route('member.dashboard');
        }

        $socials = $this->getPersonSocialProfiles($person);

        if($this->canBeClaimedViaSocial($socials, $user, $person))
        {
            $person->user_id = $claim->user_id;
            $person->save();
            $user->person_id = $claim->person_id;
            $user->save();

            $claim->verification_token = null;
            $claim->save();

            $request->session()->flash('success', 'Your claim was successfully granted.');

            return redirect()->route('member.dashboard');
        }
    }

    private function hasUserRaisedAClaimBefore($user)
    {
        return RaisedClaim::where('user_id', '=', $user->id)->get()->count() > 0;
    }

    private function hasPersonMultipleClaimRaises($person)
    {
        return RaisedClaim::where('person_id', '=', $person->id)->get()->count() > 1;
    }

    private function checkForIdenticalEmails($user, $person)
    {
        return $user->email === $person->email || $user->email === $person->secondary_email;
    }

    private function getPersonSocialProfiles($person)
    {
        $social = [];

        if($person->linkedin !== null)
        {
            $social[] = 'linkedin';
        }

        if($person->facebook !== null)
        {
            $social[] = 'facebook';
        }

        if($person->twitter !== null)
        {
            $social[] = 'twitter';
        }

        if($person->google_scholar !== null)
        {
            $social[] = 'google';
        }

        return $social;
    }

    private function checkUsersSocialLogins($socials, $user)
    {
        $logins = UserSocialAuth::whereIn('provider_name', $socials)
            ->where('user_id', '=', $user->id)
            ->get();

        return (bool) count($logins);
    }

    private function canBeClaimedViaSocial($socials, $user, $person)
    {
        return $this->checkForIdenticalEmails($user, $person) && $this->checkUsersSocialLogins($socials, $user);
    }
}
