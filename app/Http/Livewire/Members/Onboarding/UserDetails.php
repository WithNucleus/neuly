<?php

namespace App\Http\Livewire\Members\Onboarding;

use App\Events\UserOnboardingDetailsCompleted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserDetails extends Component
{
    public $user;

    public bool $showLongForm = true;

    public $first_name;
    public $last_name;
    public $password;
    public $referred_by;
    public $referred_by_other;
    public array $interests = [];
    public $registration_code;

    public bool $success = false;

    public function mount() {
        $this->user = Auth::user();

        if ($this->user) {
            if ($this->user->last_name) {
                $this->showLongForm = false;
            }
        }
    }

    public function rules() {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|string|min:12',
            'referred_by' => 'required',
            'referred_by_other' => 'nullable',
            'interests' => 'array|nullable',
            'registration_code' => 'nullable'
        ];
    }

    public function submit() {
        $this->validate();

        $referredBy = $this->referred_by;
        if($this->referred_by_other) {
            $referredBy .= ' - ' . $this->referred_by_other;
        }

        $this->user->update([
            'name' => $this->first_name,
            'last_name' => $this->last_name,
            'password' => Hash::make($this->password),
            'referred_by' => $referredBy,
            'interests' => $this->interests,
            'registration_code' => $this->registration_code
        ]);

        event(new UserOnboardingDetailsCompleted($this->user));

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.members.onboarding.user-details', [
            'referralOptions' => [
                'Website',
                'Social Media',
                'Friend',
                'Search Engine',
                'Other'
            ],
            'interestedInOptions' => [
                'Research' => 'I want to see and explore data',
                'Education' => 'I want to learn and educate myself',
                'Care' => 'I want to browse and find treatments',
                'Enterprise' => 'I want custom data and research'
            ]
        ]);
    }
}
