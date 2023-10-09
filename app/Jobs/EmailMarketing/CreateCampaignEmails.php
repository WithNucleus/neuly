<?php

namespace App\Jobs\EmailMarketing;

use App\Models\Email;
use App\Models\EmailJourney;
use App\Models\EmailSequence;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SlackAlerts\Facades\SlackAlert;

class CreateCampaignEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $trigger;
    public string $name;
    public string $email;
    public ?int $user_id;

    public function __construct(string $trigger, string $name, string $email, ?int $user_id)
    {
        $this->trigger = $trigger;
        $this->name = $name;
        $this->email = $email;
        $this->user_id = $user_id;
    }

    public function handle()
    {
        $campaign = EmailJourney::with('emailSequences')->where('trigger', $this->trigger)->first();

        if(!$campaign) {
            SlackAlert::to('dev')->message("<@sydney> Problem creating emails for `{$this->trigger}`" . "\n" . "Campaign not found!");
            return;
        }

        foreach($campaign->emailDrips as $drip) {
            $sendAt = Carbon::now();

            if ($drip->delay !== EmailSequence::DELAY_NONE) {
                $interval = CarbonInterval::make($drip->delay);
                $sendAt->add($interval);
            }

            Email::create([
                'email_template_id' => $drip->email_template_id,
                'user_id' => $this->user_id,
                'email_journey_id' => $drip->email_journey_id,
                'email_sequence_id' => $drip->id,
                'status' => Email::STATUS_NEW,
                'from_name' => $drip->emailTemplate->from_name,
                'from_email' => $drip->emailTemplate->from_email,
                'subject' => $drip->emailTemplate->subject,
                'to_name' => $this->name,
                'to_email' => $this->email,
                'body' => $drip->emailTemplate->body,
                'send_at' => $sendAt,
            ]);
        }
    }
}
