<?php

namespace App\Http\Livewire\Public\OptIns;

use App\Models\OptIn;
use Illuminate\Http\Request;
use Livewire\Component;

class EmailOptIn extends Component
{
    public $email;
    public ?string $success = null;
    public ?string $ip = null;
    public ?string $form = null;

    protected $rules = [
        'email' => 'required|email'
    ];

    public function mount(Request $request) {
        $this->ip = $request->getClientIp();
    }

    public function save() {
        $this->validate();

        OptIn::create([
            'form' => $this->form,
            'email' => $this->email,
            'ip' => $this->ip
        ]);

        $this->success = "Success! You've been subscribed.";
    }

    public function render()
    {
        return view('livewire.public.opt-ins.email-opt-in');
    }
}
