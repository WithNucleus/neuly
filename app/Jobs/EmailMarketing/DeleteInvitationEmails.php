<?php

namespace App\Jobs\EmailMarketing;

use App\Models\Email;
use App\Models\EmailJourney;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteInvitationEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function handle()
    {
        $emailJourney = EmailJourney::where('name', EmailJourney::JOURNEY_INVITED_USERS)->firstOrFail();

        Email::deletable()->where('email_preference_email', $this->email)->where('email_journey_id', $emailJourney->id)->delete();
    }
}
