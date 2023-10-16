<?php

namespace App\Jobs\EmailMarketing;

use App\Models\Email;
use App\Models\EmailTrigger;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SlackAlerts\Facades\SlackAlert;

class CreateAdminEmailsFromTrigger implements ShouldQueue
{
    public string $trigger;
    public array $mergeFields;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(string $trigger, array $mergeFields)
    {
        $this->trigger = $trigger;
        $this->mergeFields = $mergeFields;
    }

    public function handle()
    {
        $emailTrigger = EmailTrigger::with(['adminUsers'])->active()->where('trigger', $this->trigger)->first();

        if(!$emailTrigger) {
            SlackAlert::to('dev')->message("<@sydney> Problem creating emails for `{$this->trigger}`" . "\n" . "Email Trigger not found!");
            return;
        }

        if ($emailTrigger->adminResponse) {
            foreach ($emailTrigger->adminUsers as $adminUser) {
                Email::create([
                    'email_template_id' => $emailTrigger->adminResponse->id,
                    'user_id' => $adminUser->id,
                    'email_trigger_id' => $emailTrigger->id,
                    'status' => Email::STATUS_NEW,
                    'from_name' => $emailTrigger->adminResponse->from_name,
                    'from_email' => $emailTrigger->adminResponse->from_email,
                    'subject' => $emailTrigger->adminResponse->subject,
                    'to_name' => $adminUser->name,
                    'to_email' => $adminUser->email,
                    'body' => $emailTrigger->adminResponse->body,
                    'merge_fields' => $this->mergeFields,
                    'send_at' => Carbon::now(),
                ]);
            }
        }
    }
}
