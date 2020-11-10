<?php

namespace App\Mail;

use App\Models\Person;
use App\Models\RaisedClaim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyClaimedPersonMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $claim = null;
    protected $person = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RaisedClaim $claim, Person $person)
    {
        $this->claim = $claim;
        $this->person = $person;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.verify_claim')
            ->with([
                'person_name' => $this->person->name,
                'person_slug' => $this->person->slug,
                'verification_token' => $this->claim->verification_token
            ]);
    }
}
