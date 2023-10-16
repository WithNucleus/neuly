<?php

namespace App\Jobs\EmailMarketing;

use App\Models\Email;
use App\Models\EmailPreference;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SlackAlerts\Facades\SlackAlert;
use Throwable;

class ReplaceMergeValues implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public int $uniqueFor = 3600;

    public function uniqueId(): string
    {
        return $this->email->id;
    }

    public function handle()
    {
        $blackList = EmailPreference::blacklist()->where('email', $this->email->to_email)->first();

        if($blackList) {
            $this->email->status = Email::STATUS_DECLINED;
            $this->email->response = [
                Email::DECLINE_REASON_LABEL => Email::DECLINE_REASON_BLACKLIST
            ];
            $this->email->save();
        } else {
            $this->processEmail();
        }
    }

    private function processEmail() {
        $body = $this->email->body;
        $subject = $this->email->subject;

        $name = $this->email->user->name ?? $this->email->to_name;
        $body = str_replace(['{first_name}', '{first name}'], $name, $body);
        $subject = str_replace(['{first_name}', '{first name}'], $name, $subject);

        if(!empty($this->email->merge_fields)) {
            $body = $this->mergeValues($this->email->merge_fields, $body);
        }

        $this->email->body = $body;
        $this->email->subject = $subject;
        $this->email->save();

        if ($this->email->email_journey_id OR $this->email->email_sequence_id) {
            RemoveDuplicates::dispatch($this->email);
        } else {
            $this->email->status = Email::STATUS_READY;
            $this->email->save();
        }
    }

    private function mergeValues($mergeFields, $body) {
        foreach($mergeFields as $needle => $replacement) {

            if($needle === Email::MERGE_FIELD_URL) {
                $link = '<a href="' . $replacement . '">click here</a>';
                $body = str_replace("{click here}", $link, $body);
            } else {
                $body = str_replace("{{$needle}}", $replacement, $body);
            }
        }

        return $body;
    }

    public function failed(Throwable $exception): void
    {
        SlackAlert::to('dev')->message('<@sydney> Exception during Replace Merge Values for email #' . $this->email->id . "\n" . "```" . $exception->getMessage() . "```");
        $this->email->status = Email::STATUS_FAILED;
        $this->email->response = ['error' => $exception->getMessage()];
        $this->email->save();
    }
}
