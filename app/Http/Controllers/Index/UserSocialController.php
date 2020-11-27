<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\UserSocialAuth;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserSocialController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userSocialProfiles = $user->socialAuth()->get()->pluck('email', 'provider');
        $socialProviders = UserSocialAuth::getProviders();

        return view('members.settings.social', compact('user', 'userSocialProfiles', 'socialProviders'));
    }

    /**
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connect($provider)
    {
        if (!UserSocialAuth::isProviderAllowed($provider)) {
            abort(404);
        }

        $redirectUrl = route('user.settings.social.connect.callback', [$provider]);

        return Socialite::driver($provider)->redirectUrl($redirectUrl)->redirect();
    }

    public function connectCallback($provider)
    {
        if (!UserSocialAuth::isProviderAllowed($provider)) {
            abort(404);
        }

        $user = Auth::user();
        $redirectUrl = route('user.settings.social.connect.callback', [$provider]);
        $socialiteUser = Socialite::driver($provider)->redirectUrl($redirectUrl)->user();

        $socialAuth = new UserSocialAuth();
        $socialAuth->user_id = $user->id;
        $socialAuth->provider_name = $provider;
        $socialAuth->provider_id = $socialiteUser->getId();
        $socialAuth->email = $socialiteUser->getEmail();
        $socialAuth->save();

        return redirect()
            ->route('user.settings.social')
            ->with('success', 'Social account for ' . ucfirst($provider) . ' was connected successfully!');
    }

}
