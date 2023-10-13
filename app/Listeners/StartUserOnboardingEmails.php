<?php

namespace App\Listeners;

use App\Events\UserOnboardingDetailsCompleted;
use App\Jobs\EmailMarketing\CreateAdminEmailsFromTrigger;
use App\Jobs\EmailMarketing\CreateCampaignEmails;
use App\Models\EmailTrigger;
use Spatie\SlackAlerts\Facades\SlackAlert;

class StartUserOnboardingEmails
{
    const TRIGGER = EmailTrigger::TRIGGER_USER_ONBOARDING_DETAILS;

    public function handle(UserOnboardingDetailsCompleted $event): void
    {
        $emailTrigger = EmailTrigger::active()->where('trigger', self::TRIGGER)->first();

        if($emailTrigger) {
            CreateCampaignEmails::dispatch(self::TRIGGER, $event->user->name, $event->user->email, $event->user->id, []);
            CreateAdminEmailsFromTrigger::dispatch(self::TRIGGER, ['url' => route('adminx.auth.users.show', $event->user->id)]);
        } else {
            SlackAlert::to('dev')->message("<@sydney> Problem creating emails for `" . self::TRIGGER . "`" . "\n" . "Email Trigger not found!");
        }
    }
}
