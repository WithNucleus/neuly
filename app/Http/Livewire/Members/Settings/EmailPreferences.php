<?php

namespace App\Http\Livewire\Members\Settings;

use App\Models\EmailPreference;
use Livewire\Component;

class EmailPreferences extends Component
{
    public EmailPreference $emailPreference;

    protected $rules = [
        'emailPreference.do_not_email' => 'nullable|boolean',
        'emailPreference.marketing' => 'nullable|boolean',
    ];

    public function submit() {
        $this->validate();
        $this->emailPreference->save();
    }

    public function render()
    {
        return view('livewire.members.settings.email-preferences');
    }
}
