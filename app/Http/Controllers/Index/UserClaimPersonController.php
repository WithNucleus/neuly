<?php

namespace App\Http\Controllers\Index;

use App\Helpers\ClaimPersonHelper;
use App\Http\Controllers\Controller;
use App\Mail\VerifyClaimedPersonMail;
use App\Models\Person;
use App\Models\RaisedClaim;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserClaimPersonController extends Controller
{
    public function status()
    {
        $user= Auth::user();
        $claims = RaisedClaim::where('user_id', '=', $user->id)
            ->whereNotNull('verification_token')
            ->get();

        return view('members.person.status', compact('claims', 'user'));
    }

    public function verifyEmail() {
        return view('members.person.verify-mail');
    }

    public function sendVerificationMail()
    {
        $user = Auth::user();
        $claim = RaisedClaim::where('user_id', '=', $user->id)->firstOrFail();

        $claim->verification_token = RaisedClaim::generateToken();
        $claim->save();

        $person = Person::find($claim->person_id);
        $personEmails = $person->getEmails();

        if ($personEmails === []) {
            return redirect()->route('user.person.status')
                ->with('error', 'Your claim could not be verified via email. Please contact our support.');
        }

        Mail::to($personEmails)
            ->send(new VerifyClaimedPersonMail($claim, $person));

        return redirect()->route('user.person.status')
            ->with('success', 'Verification E-Mail has ben resent to the E-Mail of the Person you are trying to claim.');
    }

    public function verifyClaimByEmail($token)
    {
        $claim = RaisedClaim::where('verification_token', $token)->firstOrFail();
        $user = User::findOrFail($claim->user_id);
        $person = Person::findOrFail($claim->person_id);

        ClaimPersonHelper::acceptClaim($user, $person, $claim);

        return redirect()->route('user.person.index')
            ->with('success', 'Your claim was successfully granted.');
    }

    public function verifySocial() {
        $user = Auth::user();
        $claim = RaisedClaim::where('user_id', $user->id)
            ->whereNotNull('verification_token')
            ->firstOrFail();

        return view('members.person.verify-social', compact('claim'));
    }

    public function verifyClaimBySocial()
    {
        $user = Auth::user();
        $claim = RaisedClaim::where('user_id', $user->id)->firstOrFail();
        $person = Person::findOrFail($claim->person_id);
        $personSocials = $person->getSocialProfiles();

        if ($personSocials === []) {
            return redirect()->route('user.person.status')
                ->with('error', 'Your claim could not be verified via social. Please use email verification or contact us.');
        }

        if (ClaimPersonHelper::checkBySocials($user, $person) === false) {
            return redirect()->route('user.person.status')
                ->with('error', 'You need to connect one of these social profiles to your account: ' . implode(', ', $personSocials) . '.');
        }

        ClaimPersonHelper::acceptClaim($user, $person, $claim);

        return redirect()->route('user.person.index')
            ->with('success', 'Your claim was successfully granted.');
    }
}
