<?php

namespace App\Http\Livewire\Members\Settings;

use App\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Throwable;

class Profile extends Component
{
    public User $user;
    public ?string $success = null;
    public ?string $error = null;

    public function rules() {
        return [
            'user.name' => 'required|string',
            'user.last_name' => 'required|string',
            'user.member_url' => [
                'nullable',
                'max:25',
                'alpha_dash',
                Rule::unique('users', 'member_url')->ignore($this->user->id)
            ]
        ];
    }

    public function save() {
        $this->validate();

        try {
            $this->user->save();
            $this->success = 'Profile updated!';
        } catch (Throwable $exception)  {
            $this->error = 'There was a problem. Sorry! Let us know if it continues.';
        }
    }

    public function render()
    {
        return view('livewire.members.settings.profile');
    }
}
