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
        $emails = Email::pending()->where('send_at', '<=', $now)->get();

        foreach($emails as $email) {
            foreach($email->to as $recipient) {
                if (in_array($recipient, $blackList)) {
                    $email->status = Email::STATUS_DECLINED;
                    $email->response = ['decline_reason' => 'Email in blacklist'];
                } else {
                    Mail::to($recipient)->queue(new EmailMarketingMail($email));
                    $email->status = Email::STATUS_SENT;
                }

                $email->save();
            }
        }
    }

    public function failed(Throwable $exception)
    {
        $message = 'Failed Job EmailMarketing/SendEmails' . "\n" . $exception->getMessage();
        Log::warning($message);
        SlackAlert::to('dev')->message('<@sydney> ' . $message);
    }
}
