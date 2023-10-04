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
        $emails = Email::new()->get();

        foreach($emails as $email) {
            // Fields
            $body = $email->body;
            $subject = $email->subject;

            // New Values
            $name = $email->user->name ?? 'there';

            // Replacements
            $body = str_replace(['{first_name}', '{first name}'], $name, $body);
            $subject = str_replace(['{first_name}', '{first name}'], $name, $subject);

            $email->body = $body;
            $email->subject = $subject;
            $email->status = Email::STATUS_PENDING;
            $email->save();
        }
    }
}
