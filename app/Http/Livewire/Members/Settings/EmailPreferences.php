<?php

namespace App\Http\Livewire\Members\Settings;

use App\Models\EmailPreference;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class EmailPreferences extends Component
{
    public EmailPreference $emailPreference;

    public ?string $ip;

    public function mount(Request $request) {
        $this->ip = $request->getClientIp();
    }

    protected $rules = [
        'emailPreference.do_not_email' => 'nullable|boolean',
        'emailPreference.marketing' => 'nullable|boolean',
    ];

    public function submit() {
        $this->validate();

        if($this->emailPreference->do_not_email === true) {
            $this->emailPreference->opt_out = Carbon::now();
        } else {
            $this->emailPreference->opt_out = NULL;
        }

        if ($this->emailPreference->opt_in_ip === NULL) {
            $this->emailPreference->opt_in_ip = $this->ip;
        }

        $this->emailPreference->save();
    }

    public function render()
    {
        return view('livewire.members.settings.email-preferences');
    }
}
