<?php

namespace App\Jobs\EmailMarketing;

use App\Models\Email;
use Illuminate\Bus\Queueable;
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
            ReplaceMergeValues::dispatch($email);
        }
    }
}
