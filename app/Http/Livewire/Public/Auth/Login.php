<?php

namespace App\Http\Livewire\Public\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    protected $listeners = ['showLoginForm'];

    public $email;
    public $password;

    public ?string $redirect = null;
    public bool $showForm = false;
    public bool $showEmail = true;

    public ?string $message = null;
    public ?string $success = null;
    public ?string $error = null;

    public function showLoginForm($email, $message, $showEmail) {
        $this->showForm = true;
        $this->email = $email;
        $this->message = $message;
        $this->showEmail = $showEmail;
    }

    public function rules() {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function submit() {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], true)) {
            $this->success = 'Success! You are logged in.';
            $this->reset('message');
            $this->reset('error');
//            $this->emitTo(IntakeForm::class, 'userLoggedIn');
        } else {
            $this->reset('success');
            $this->error = 'Your credentials do not match.';
        }
    }

    public function render()
    {
        return view('livewire.public.auth.login');
    }
}
