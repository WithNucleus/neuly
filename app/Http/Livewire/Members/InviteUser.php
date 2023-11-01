<?php

namespace App\Http\Livewire\Members;

use App\Models\EmailJourney;
use App\Models\EmailPreference;
use App\Models\UserInvitation;
use App\User;
use Livewire\Component;

class InviteUser extends Component
{
    public User $user;
    public $first_name;
    public $last_name;
    public $email;

    public ?string $error = null;
    public ?string $success = null;

    public function rules() {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ];
    }

    public function submit() {
        $this->validate();

        if (User::where('email', $this->email)->first() OR UserInvitation::where('email_preference_email', $this->email)->first()) {
            $this->error = 'This person is a Neuly member or has been invited recently';
            $this->reset('success');
        } else {

            $emailPreference = EmailPreference::updateOrCreate(['email' => $this->email], [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email
            ]);

            $emailJourney = EmailJourney::where('name', EmailJourney::JOURNEY_INVITED_USERS)->firstOrFail();

            UserInvitation::create([
                'inviter_id' => $this->user->id,
                'email_preference_email' => $emailPreference->id,
                'email_journey_id' => $emailJourney->id,
                'token' => UserInvitation::generateToken()
            ]);

            $this->reset('error');
            $this->success = 'Success! We sent your invitation to ' . $this->email;
            $this->reset('first_name');
            $this->reset('last_name');
            $this->reset('email');
        }
    }

    public function render()
    {
        return view('livewire.members.invite-user');
    }
}
