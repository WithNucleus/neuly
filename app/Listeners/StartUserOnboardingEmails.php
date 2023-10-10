<?php

namespace App\Listeners;

use App\Events\UserOnboardingDetailsCompleted;
use App\Jobs\EmailMarketing\CreateCampaignEmails;
use App\Models\EmailTrigger;

class StartUserOnboardingEmails
{
    public function handle(UserOnboardingDetailsCompleted $event)
    {
        CreateCampaignEmails::dispatch(EmailTrigger::TRIGGER_USER_ONBOARDING_DETAILS, $event->user->name, $event->user->email, $event->user->id);
    }
}
