<?php

namespace App\Jobs\EmailMarketing;

use App\Models\Email;
use App\Models\EmailSequence;
use App\Models\EmailTrigger;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Bus\Queueable;
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
    public ?array $mergeFields;

    public function __construct(string $trigger, string $name, string $email, ?int $user_id, ?array $mergeFields)
    {
        $this->trigger = $trigger;
        $this->name = $name;
        $this->email = $email;
        $this->user_id = $user_id;
        $this->mergeFields = $mergeFields;
    }

    public function handle()
    {
        $emailTrigger = EmailTrigger::active()->where('trigger', $this->trigger)->first();

        if(!$emailTrigger) {
            SlackAlert::to('dev')->message("<@sydney> Problem creating emails for `{$this->trigger}`" . "\n" . "Email Trigger not found!");
            return;
        }

        if ($emailTrigger->autoResponse) {
            Email::create([
                'email_template_id' => $emailTrigger->autoResponse->id,
                'user_id' => $this->user_id,
                'email_trigger_id' => $emailTrigger->id,
                'status' => Email::STATUS_NEW,
                'from_name' => $emailTrigger->autoResponse->from_name,
                'from_email' => $emailTrigger->autoResponse->from_email,
                'subject' => $emailTrigger->autoResponse->subject,
                'to_name' => $this->name,
                'to_email' => $this->email,
                'body' => $emailTrigger->autoResponse->body,
                'merge_fields' => $this->mergeFields,
                'send_at' => Carbon::now(),
            ]);
        }

        if ($emailTrigger->emailJourney) {

            foreach($emailTrigger->emailJourney->emailSequences as $sequence) {

                $sendAt = Carbon::now();

                if ($sequence->delay !== EmailSequence::DELAY_NONE) {
                    $interval = CarbonInterval::make($sequence->delay);
                    $sendAt->add($interval);
                }

                Email::create([
                    'email_template_id' => $sequence->email_template_id,
                    'user_id' => $this->user_id,
                    'email_journey_id' => $sequence->email_journey_id,
                    'email_sequence_id' => $sequence->id,
                    'email_trigger_id' => $emailTrigger->id,
                    'status' => Email::STATUS_NEW,
                    'from_name' => $sequence->emailTemplate->from_name,
                    'from_email' => $sequence->emailTemplate->from_email,
                    'subject' => $sequence->emailTemplate->subject,
                    'to_name' => $this->name,
                    'to_email' => $this->email,
                    'body' => $sequence->emailTemplate->body,
                    'send_at' => $sendAt,
                ]);
            }
        }
    }
}
