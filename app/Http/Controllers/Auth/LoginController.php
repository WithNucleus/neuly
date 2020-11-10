<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserSocialAuth;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Overwrite showLoginForm to save the previous URL into the session.
     *
     * @return View
     */
    public function showLoginForm()
    {
        session()->put('loginRedirect', url()->previous());
        return view('auth.login');
    }

    /**
     * Overwrite $redirectTo property to redirect to previous page.
     *
     * @return string URL to redirect to
     */
    public function redirectTo()
    {
        return session('loginRedirect');
    }

    /**
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|void
     */
    public function redirectToProvider($provider)
    {
        if (!$this->isProviderAllowed($provider)) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from OAuth provider.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            if (!$this->isProviderAllowed($provider)) {
                throw new \Exception();
            }

            $socialiteUser = Socialite::driver($provider)->user();
            $user          = User::whereHas('socialAuth', function ($query) use ($provider, $socialiteUser) {
                    $query->where('provider_name', $provider)
                        ->where('provider_id', $socialiteUser->getId());
                })->first();

            if (!$user) {
                $name = $socialiteUser->getName();
                $nameParts = explode(' ', $name);

                if (count($nameParts) === 2) {
                    $firstName = $nameParts[0];
                    $lastName = $nameParts[1];
                } else {
                    $firstName = $name;
                    $lastName = null;
                }

                $user = User::firstOrCreate([
                    'email' => $socialiteUser->getEmail()
                ], [
                    'name'              => $firstName,
                    'last_name'         => $lastName,
                    'password'          => Hash::make(Str::random('20')),
                    'email_verified_at' => Carbon::now(),
                ])->assignRole('Subscriber');

                event(new Verified($user));

                $socialAuth = new UserSocialAuth();
                $socialAuth->user_id = $user->id;
                $socialAuth->provider_name = $provider;
                $socialAuth->provider_id = $socialiteUser->getId();
                $socialAuth->save();
            }

            auth()->login($user);

            return redirect()->intended($this->redirectPath());

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', "Failed to authenticate with $provider");
        }
    }

    private function isProviderAllowed($provider){
        return in_array($provider, ['facebook', 'google', 'twitter', 'linkedin']);
    }
}
