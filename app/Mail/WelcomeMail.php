<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use SerializesModels;

    /**
     * @var string
     */
    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return Mailable
     */
    public function build()
    {
        return $this->markdown('emails.users.welcome')
            ->with([
                'name' => $this->name,
            ])
            ->subject("{$this->name}, Welcome to Neuly!");
    }
}
