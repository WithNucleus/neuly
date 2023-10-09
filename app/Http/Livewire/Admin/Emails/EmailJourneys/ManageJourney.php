<?php

namespace App\Http\Livewire\Admin\Emails\EmailJourneys;

use App\Models\EmailJourney;
use Livewire\Component;

class ManageJourney extends Component
{
    public EmailJourney $emailJourney;

    public function render()
    {
        return view('livewire.admin.emails.email-journeys.manage-journey');
    }
}
