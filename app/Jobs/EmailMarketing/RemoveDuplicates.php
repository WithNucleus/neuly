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

class RemoveDuplicates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function handle()
    {
        $otherEmails = Email::where('email_template_id', $this->email->email_template_id)
        ->where('to_email', $this->email->to_email)
        ->where('id', '!=', $this->email->id)
        ->get();

        if ($otherEmails->count() > 0) {
            $this->email->delete();
        } else {
            $blackList = EmailPreference::blacklist()->where('email', $this->email->to_email)->first();

            if($blackList) {
                $this->email->status = Email::STATUS_DECLINED;
                $this->email->response = [
                    Email::DECLINE_REASON_LABEL => Email::DECLINE_REASON_BLACKLIST
                ];
            } else {
                $this->email->status = Email::STATUS_READY;
            }

            $this->email->save();
        }
    }
}
