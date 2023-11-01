<?php

namespace App\Http\Livewire\Members\Onboarding;

use App\Events\UserOnboardingDetailsCompleted;
use App\Jobs\EmailMarketing\DeleteInvitationEmails;
use App\Models\Role;
use App\Models\UserInvitation;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\SlackAlerts\Facades\SlackAlert;
use Throwable;

class AcceptInvitation extends Component
{
    public UserInvitation $invitation;

    public $first_name;
    public $last_name;
    public $password;
    public array $interests = [];

    public bool $success = false;
    public ?string $error = null;

    public ?string $dashboardLink = null;

    public function mount() {
        $this->first_name = $this->invitation->emailPreference->first_name;
        $this->last_name = $this->invitation->emailPreference->last_name;
    }

    public function rules() {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|string|min:12',
            'interests' => 'array|nullable',
        ];
    }

    public function submit() {
        $this->validate();

        try {
            $user = User::create([
                'name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->invitation->email_preference_email,
                'password' => Hash::make($this->password),
                'interests' => $this->interests,
                'email_verified_at' => Carbon::now()
            ])->assignRole(Role::ROLE_SUBSCRIBER);

            $this->invitation->invitee_id = $user->id;
            $this->invitation->save();

            event(new UserOnboardingDetailsCompleted($user));
            $this->dashboardLink = $user->dashboard_link;

            DeleteInvitationEmails::dispatch($this->invitation->email_preference_email);

            if (Auth::attempt(['email' => $user->email, 'password' => $this->password], true)) {
                $this->success = true;
            } else {
                $this->error = 'Sorry, there was a problem logging you in. Please email sydney@withnucleus.com';
            }

        } catch(Throwable $exception) {
            SlackAlert::to('dev')->message('<@sydney> *Problem during Accept Invitation* ' . $this->invitation->email_preference_email . "\n" . "```" . $exception->getMessage() . "```");
            $this->error = 'Sorry, there was a problem completing your profile. Please email sydney@withnucleus.com';
        }
    }

    public function render()
    {
        return view('livewire.members.onboarding.accept-invitation', [
            'interestedInOptions' => [
                'Research' => 'I want to see and explore data',
                'Education' => 'I want to learn and educate myself',
                'Care' => 'I want to browse and find treatments',
                'Enterprise' => 'I want custom data and research'
            ]
        ]);
    }
}
