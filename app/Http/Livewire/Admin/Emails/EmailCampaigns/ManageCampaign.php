<?php

namespace App\Http\Livewire\Admin\Emails\EmailCampaigns;

use App\Models\EmailCampaign;
use Livewire\Component;

class ManageCampaign extends Component
{
    public EmailCampaign $emailCampaign;

    public function render()
    {
        return view('livewire.admin.emails.email-campaigns.manage-campaign');
    }
}
