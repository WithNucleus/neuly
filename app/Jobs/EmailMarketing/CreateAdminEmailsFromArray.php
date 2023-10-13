<?php

namespace App\Jobs\EmailMarketing;

use App\Models\Email;
use App\Models\EmailTrigger;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SlackAlerts\Facades\SlackAlert;

class CreateAdminEmailsFromArray implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $trigger;
    public array $userIds;
    public ?array $mergeFields;

    public function __construct(string $trigger, array $userIds, ?array $mergeFields)
    {
        $this->trigger = $trigger;
        $this->userIds = $userIds;
        $this->mergeFields = $mergeFields;
    }

    public function handle()
    {
        $emailTrigger = EmailTrigger::active()->where('trigger', $this->trigger)->first();

        if(!$emailTrigger) {
            SlackAlert::to('dev')->message("<@sydney> Problem creating emails for `{$this->trigger}`" . "\n" . "Email Trigger not found!");
            return;
        }

        foreach($this->userIds as $userId) {
            $user = User::findOrFail($userId);

            if ($emailTrigger->adminResponse) {
                Email::create([
                    'email_template_id' => $emailTrigger->adminResponse->id,
                    'user_id' => $user->id,
                    'email_trigger_id' => $emailTrigger->id,
                    'status' => Email::STATUS_NEW,
                    'from_name' => $emailTrigger->adminResponse->from_name,
                    'from_email' => $emailTrigger->adminResponse->from_email,
                    'subject' => $emailTrigger->adminResponse->subject,
                    'to_name' => $user->name,
                    'to_email' => $user->email,
                    'body' => $emailTrigger->adminResponse->body,
                    'merge_fields' => $this->mergeFields,
                    'send_at' => Carbon::now(),
                ]);
            }
        }
    }
}
