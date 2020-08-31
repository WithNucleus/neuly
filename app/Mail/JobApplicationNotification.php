<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The full name of the user
     *
     * @var string
     */
    private $fullName;

    /**
     * The position
     *
     * @var string
     */
    private $position;

    /**
     * The organization
     *
     * @var string
     */
    private $organization;

    /**
     * The path to resume file
     *
     * @var string
     */
    private $resume;

    /**
     * The path to cover letter file
     *
     * @var string
     */
    private $cover_letter;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $job_id, string $fullName, string $organization, string $position, string $resume, string $cover_letter)
    {
        $this->job_id       = $job_id;
        $this->fullName     = $fullName;
        $this->organization = $organization;
        $this->position     = $position;
        $this->resume       = $resume;
        $this->cover_letter = $cover_letter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.jobs.apply_notification')
            ->with([
                'organization' => $this->organization,
                'fullName'     => $this->fullName,
                'position'     => $this->position,
            ])
            ->attach(storage_path() . '/app/' . $this->resume)
            ->attach(storage_path() . '/app/' . $this->cover_letter)
            ->subject('Job Application: ' . $this->position . ' - ' . $this->fullName);
    }
}
