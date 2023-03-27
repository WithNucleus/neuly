<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetChangedMailAddressMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The name of the user
     *
     * @var string
     */
    private $name;

    /**
     * The new mail address
     *
     * @var string
     */
    private $newMailAddress;

    /**
     * The link for resetting the changed mail
     *
     * @var string
     */
    private $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $newMailAddress, string $link)
    {
        $this->name = $name;
        $this->newMailAddress = $newMailAddress;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.reset_changed_mail')
            ->with([
                'name' => $this->name,
                'newMailAddress' => $this->newMailAddress,
                'link' => $this->link,
            ])
            ->subject('Your email was changed on Neuly');
    }
}
