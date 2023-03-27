<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The name of the user
     *
     * @var string
     */
    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.password_changed')
                    ->with([
                        'name' => $this->name,
                    ])
                    ->subject('Your password was changed');
    }
}
