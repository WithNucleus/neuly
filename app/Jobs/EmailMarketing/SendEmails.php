<?php

namespace App\Jobs\EmailMarketing;

use App\Mail\EmailMarketingMail;
use App\Models\Email;
use App\Models\EmailPreference;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\SlackAlerts\Facades\SlackAlert;
use Throwable;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $now = Carbon::now();
        $blackList = EmailPreference::blacklist()->pluck('email')->toArray();
        $emails = Email::ready()->where('send_at', '<=', $now)->get();

        foreach($emails as $email) {
            if (in_array($email->to_email, $blackList)) {
                $email->status = Email::STATUS_DECLINED;
                $email->response = [
                    Email::DECLINE_REASON_LABEL => Email::DECLINE_REASON_BLACKLIST
                ];
            } else {
                Mail::to($email->to_email)->queue(new EmailMarketingMail($email));
                $email->status = Email::STATUS_SENT;
                $email->sent_at = Carbon::now();
            }

            $email->save();
        }
    }

    public function failed(Throwable $exception)
    {
        $message = 'Failed Job EmailMarketing/SendEmails' . "\n" . "```{$exception->getMessage()}```";
        Log::warning($message);
        SlackAlert::to('dev')->message('<@sydney> ' . $message);
    }
}
