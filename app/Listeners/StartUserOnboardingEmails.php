<?php

namespace App\Listeners;

use App\Events\UserOnboardingDetailsCompleted;
use App\Jobs\EmailMarketing\CreateCampaignEmails;
use App\Models\EmailCampaign;

class StartUserOnboardingEmails
{
    public function handle(UserOnboardingDetailsCompleted $event)
    {
        CreateCampaignEmails::dispatch(EmailCampaign::TRIGGER_ONBOARDING_USER_DETAILS_COMPLETE, $event->user->name, $event->user->email, $event->user->id);
    }
}
