<?php

namespace App\Notifications;

use App\Mail\JobApplicationMail;
use App\Models\JobApplication;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class JobApplicationCreated extends Notification
{
    /**
     * @var \App\Models\JobApplication
     */
    public $jobApplication;

    /**
     * @param \App\Models\JobApplication $jobApplication
     */
    public function __construct(JobApplication $jobApplication)
    {
        $this->jobApplication = $jobApplication;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \App\Mail\JobApplicationMail
     */
    public function toMail($notifiable)
    {
        return (new JobApplicationMail($this->jobApplication));
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url          = route('jobapplication.show', $this->jobApplication->id);
        $applicant    = $this->jobApplication->applicantName;
        $organization = $this->jobApplication->company->name;
        $position     = $this->jobApplication->job->job_title;

        return (new SlackMessage)
            ->content('Job application received')
            ->attachment(function ($attachment) use ($url, $applicant, $organization, $position) {
                $attachment->title('Show', $url)
                    ->fields([
                        'Applicant'    => $applicant,
                        'Organization' => $organization,
                        'Position'     => $position
                    ]);
            });
    }
}
