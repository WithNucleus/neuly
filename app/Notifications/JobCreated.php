<?php

namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class JobCreated extends Notification
{
    use Queueable;

    private $job;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack()
    {
        $url = route('discover.jobs.show', $this->job->slug);
        $adminUrl = route('job.show', $this->job->id);

        return (new SlackMessage)->content('A new job was created: ' . $this->job->name)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('Show job', $url)
                    ->fields([
                        'Job' => $this->job->name
                    ]);
            })
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate job', $adminUrl)
                    ->fields([
                        'Job' => $this->job->name
                    ]);
            });
    }
}
