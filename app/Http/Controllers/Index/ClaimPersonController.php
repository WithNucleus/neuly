<?php

namespace App\Http\Controllers\Index;

use App\Helpers\ClaimPersonHelper;
use App\Http\Controllers\Controller;
use App\Mail\VerifyClaimedPersonMail;
use App\Model\UserSocialAuth;
use App\Models\Person;
use App\Models\RaisedClaim;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClaimPersonController extends Controller
{
    public function claim(Request $request, $slug)
    {
        $user = Auth::user();
        $person = Person::where('slug', '=', $slug)->firstOrFail();

        if($user->hasRaisedClaimBefore())
        {
            $request->session()->flash('error', 'You can only raise one claim at the same time.');

            return redirect()->route('discover.people.show', ['slug' => $person->slug]);
        }

        $socials = $person->getSocialProfiles();


        //ToDo: this isn't 100% secure yet and needs some additional polish
        if(ClaimPersonHelper::canBeClaimedViaSocial($socials, $user, $person))
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

        if($user->hasRaisedMultipleClaims())
        {
            return redirect()->route('user.person.status')
                ->with('error', 'There has been a problem with your claim. Please contact us at support@neuly.com.');
        }

        $person->user_id = $claim->user_id;
        $person->save();
        $user->person_id = $claim->person_id;
        $user->save();

        $claim->verification_token = null;
        $claim->save();

        return redirect()->route('user.person.status')
            ->with('success', 'Your claim was successfully granted.');
    }

    public function verifyClaimBySocial(Request $request, RaisedClaim $claim)
    {
        $person = Person::find($claim->person_id);
        $user = User::find($claim->user_id);

        if($user->hasRaisedMultipleClaims())
        {
            return redirect()->route('user.person.status')
                ->with('error', 'There has been a problem with your claim. Please contact us at support@neuly.com.');
        }

        $socials = $person->getSocialProfiles();

        if(ClaimPersonHelper::canBeClaimedViaSocial($socials, $user, $person))
        {
            $person->user_id = $claim->user_id;
            $person->save();
            $user->person_id = $claim->person_id;
            $user->save();

            $claim->verification_token = null;
            $claim->save();

            return redirect()->route('user.person.status')
                ->with('success', 'Your claim was successfully granted.');
        }

        return redirect()->route('user.person.status')
            ->with('error', 'Your claim could not be verified.');
    }

    public function sendVerificationMail(Request $request)
    {
        $user = Auth::user();
        $claim = RaisedClaim::where('user_id', '=', $user->id)
            ->whereNotNull('verification_token')
            ->firstOrFail();

        $claim->verification_token = sha1(time());
        $claim->save();

        $person = Person::find($claim->person_id);

        if($person->email === null) {
            return redirect()->route('user.person.status')
                ->with('error', 'Verification E-Mail could not be send. Please use social verification or contact us.');
        }

        Mail::to($person->email)
            ->send(new VerifyClaimedPersonMail($claim, $person));

        return redirect()->route('user.person.status')
            ->with('success', 'Verification E-Mail has ben resent to the E-Mail of the Person you are trying to claim.');
    }
}
