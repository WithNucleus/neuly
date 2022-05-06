<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ClinicalTrialCreated extends Notification
{
    use Queueable;

    private $clinicalTrial;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ClinicalTrial $clinicalTrial)
    {
        $this->clinicalTrial = $clinicalTrial;
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
        $url = route('discover.clinicaltrials.show', $this->clinicalTrial->slug);
        $adminUrl = route('clinicaltrial.show', $this->clinicalTrial->id);

        return (new SlackMessage)->content('A new clinical trial was created: ' . $this->clinicalTrial->name)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('Show clinical trial', $url)
                    ->fields([
                        'Clinical Trial' => $this->clinicalTrial->name
                    ]);
            })
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate clinical trial', $adminUrl)
                    ->fields([
                        'Clinical Trial' => $this->clinicalTrial->name
                    ]);
            });
    }

}
