<?php

namespace App\Jobs\EmailMarketing;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PrepEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $emails = Email::new()->orderByDesc('id')->get();

        foreach($emails as $email) {
            $body = $email->body;
            $subject = $email->subject;

            // Replace Name
            $name = $email->user->name ?? $email->to_name;
            $body = str_replace(['{first_name}', '{first name}'], $name, $body);
            $subject = str_replace(['{first_name}', '{first name}'], $name, $subject);

            if(!empty($email->merge_fields)) {
                $body = $this->mergeValues($email->merge_fields, $body);
            }

            $email->body = $body;
            $email->subject = $subject;
            $email->status = Email::STATUS_PENDING;
            $email->save();

            RemoveDuplicates::dispatch($email);
        }
    }

    private function mergeValues($mergeFields, $body) {
        foreach($mergeFields as $needle => $replacement) {
            $body = str_replace("{{$needle}}", $replacement, $body);
        }

        return $body;
    }
}
