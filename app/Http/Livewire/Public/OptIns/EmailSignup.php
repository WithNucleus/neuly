<?php

namespace App\Http\Livewire\Public\OptIns;

use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\SlackAlerts\Facades\SlackAlert;
use Throwable;

class EmailSignup extends Component
{
    public $email;
    public ?string $success = null;
    public ?string $error = null;
    public ?string $ip = null;

    public function mount(Request $request) {
        $this->ip = $request->getClientIp();
    }

    protected $rules = [
        'email' => 'required|email'
    ];

    public function submit()
    {
        $this->validate();

        $existingUser = User::where('email', $this->email)->first();

        if ($existingUser) {
            $this->success = 'You have a Neuly account. Redirecting you to log in...';
            $this->dispatchBrowserEvent('redirect-to-url-delay', ['url' => route('member.dashboard')]);
        } else {
            try {
                $userArray = explode('@', $this->email);
                $password = Str::random();

                $user = User::create([
                    'name' => $userArray[0],
                    'email' => $this->email,
                    'password' => Hash::make($password)
                ]);

                $user->assignRole(Role::ROLE_SUBSCRIBER);

                $user->sendEmailVerificationNotification();

                if (Auth::attempt(['email' => $this->email, 'password' => $password], true)) {
                    $this->success = "Welcome to Neuly! Please check your email for a verification link.";
                    $this->reset('error');
//                    $this->dispatchBrowserEvent('redirect-to-url-delay', ['url' => route('member.dashboard')]);
                } else {
                    $this->reset('success');
                    $this->error = 'There was a problem authenticating you. Please contact sydney@withnucleus.com';
                }

            } catch (Throwable $exception) {
                // TODO: Slack notification
                SlackAlert::to('dev')->message('<@sydney> . *EXCEPTION DURING EMAIL SIGNUP*' . "\n" .
                    'Email: ' . $this->email . "\n" .
                    'IP: ' . $this->ip . "\n" .
                    $exception->getMessage() . "\n");
                $this->error = $exception->getMessage();
            }
        }
    }

    public function render()
    {
        return view('livewire.public.opt-ins.email-signup');
    }
}
