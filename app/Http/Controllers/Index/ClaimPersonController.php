<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
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


        $claim = new RaisedClaim();
        $claim->user_id = $user->id;
        $claim->person_id = $person->id;
        $claim->verification_token = sha1(time());
        $claim->save();

        //do email sending

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

    private function hasUserRaisedAClaimBefore($user)
    {
        return RaisedClaim::where('user_id', '=', $user->id)->get()->count() > 0;
    }

    private function hasPersonMultipleClaimRaises($person)
    {
        return RaisedClaim::where('person_id', '=', $person->id)->get()->count() > 1;
    }
}
