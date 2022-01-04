<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeamInvitationMail extends Mailable
{
    use SerializesModels;

    /**
     * @var string
     */
    private $teamName;

    /**
     * @var string
     */
    private $inviterName;

    /**
     * @var string
     */
    private $invitationCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($teamName, $inviterName, $invitationCode)
    {
        $this->teamName = $teamName;
        $this->inviterName = $inviterName;
        $this->invitationCode = $invitationCode;
    }

    /**
     * Build the message.
     *
     * @return Mailable
     */
    public function build()
    {
        return $this->markdown('emails.users.team.invitation')
            ->with([
                'teamName' => $this->teamName,
                'inviterName' => $this->inviterName,
                'url' => route('invitation.show', ['code' => $this->invitationCode])
            ])
            ->subject('You have been invited to join the Neuly team.');
    }
}
