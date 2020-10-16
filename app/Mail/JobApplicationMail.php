<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The full name of the user
     *
     * @var JobApplication
     */
    private $jobApplication;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JobApplication $jobApplication)
    {
        $this->jobApplication = $jobApplication;
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
                'organization' => $this->jobApplication->company->name,
                'fullName'     => $this->jobApplication->applicantName,
                'position'     => $this->jobApplication->job->job_title,
            ])
            ->attach(storage_path() . '/app/' . $this->jobApplication->resume)
            ->attach(storage_path() . '/app/' . $this->jobApplication->cover_letter)
            ->subject('Job Application: ' . $this->jobApplication->job->job_title . ' - ' . $this->jobApplication->applicantName);
    }
}
