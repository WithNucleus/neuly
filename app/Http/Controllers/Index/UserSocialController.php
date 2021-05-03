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
        $userSocialProfiles = $user->socialAuth()->get()->pluck('email', 'provider_name');
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

        return Socialite::driver($provider)->redirect();
    }

}
