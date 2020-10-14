<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\RaisedClaim;
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

    private function hasUserRaisedAClaimBefore($user)
    {
        return RaisedClaim::where('user_id', '=', $user->id)->get()->count() > 0;
    }
}
