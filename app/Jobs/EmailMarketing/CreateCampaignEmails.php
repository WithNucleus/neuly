<?php

namespace App\Jobs\EmailMarketing;

use App\Models\Email;
use App\Models\EmailCampaign;
use App\Models\EmailDrip;
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
        $campaign = EmailCampaign::with('emailDrips')->where('trigger', $this->trigger)->first();

        if(!$campaign) {
            SlackAlert::to('dev')->message("<@sydney> Problem creating emails for `{$this->trigger}`" . "\n" . "Campaign not found!");
            return;
        }

        foreach($campaign->emailDrips as $drip) {
            $sendAt = Carbon::now();

            if ($drip->delay !== EmailDrip::DELAY_NONE) {
                $interval = CarbonInterval::make($drip->delay);
                $sendAt->add($interval);
            }

            Email::create([
                'email_template_id' => $drip->email_template_id,
                'user_id' => $this->user_id,
                'email_campaign_id' => $drip->email_campaign_id,
                'email_drip_id' => $drip->id,
                'status' => Email::STATUS_NEW,
                'from_name' => $drip->from_name,
                'from_email' => $drip->from_email,
                'subject' => $drip->subject,
                'to_name' => $this->name,
                'to_email' => $this->email,
                'body' => $drip->body,
                'send_at' => $sendAt,
            ]);
        }
    }
}
