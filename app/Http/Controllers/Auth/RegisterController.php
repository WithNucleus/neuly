<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showRegistrationForm(Request $request)
    {
        $invitation = null;
        $invitedByName = null;

        if ($code = $request->get('code')) {
            $invitation = TeamInvitation::where('code', $code)->first();

            if ($invitation) {
                $team = Team::with('owner')->find($invitation->team_id);
                $invitedByName = $team->owner->fullname;
            } else {
                Session::flash('error', 'Invitation code is invalid.');
            }
        }

        return view('auth.register', [
            'invitation' => $invitation,
            'invitedByName' => $invitedByName,
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'role' => 'required',
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        if ($data['role'] == 'Team owner') {
            $rules['team_name'] = ['required', 'string', 'min:2', 'max:255'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])->assignRole($data['role']);

        //registered as team
        if ($user->hasRole('Team owner')) {
            Team::create([
                'owner_id' => $user->id,
                'name' => $data['team_name'],
            ]);
        }

        //registered as team member by invitation
        if (isset($data['team_id'])) {
            $team = Team::findOrFail($data['team_id']);
            $team->addMember($user);

            TeamInvitation::where('team_id', $team->id)
                ->where('email', $user->email)
                ->delete();
        }

        return $user;
    }
}
