<?php

namespace App\Listeners;

use App\Events\UserOnboardingDetailsCompleted;
use App\Jobs\EmailMarketing\CreateCampaignEmails;
use App\Models\EmailJourney;

class StartUserOnboardingEmails
{
    public function handle(UserOnboardingDetailsCompleted $event)
    {
        CreateCampaignEmails::dispatch(EmailJourney::TRIGGER_ONBOARDING_USER_DETAILS_COMPLETE, $event->user->name, $event->user->email, $event->user->id);
    }
}
