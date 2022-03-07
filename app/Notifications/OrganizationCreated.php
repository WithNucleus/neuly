<?php

namespace App\Notifications;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class OrganizationCreated extends Notification
{
    use Queueable;

    private $organization;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Company $organization)
    {
        $this->organization = $organization;
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
        $url = route('discover.organizations.show', $this->organization->slug);
        $adminUrl = route('company.show', $this->organization->id);

        return (new SlackMessage)->content('A new organization was created: ' . $this->organization->name)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('Show organization', $url)
                    ->fields([
                        'Organization' => $this->organization->name
                    ]);
            })
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate organization', $adminUrl)
                    ->fields([
                        'Organization' => $this->organization->name
                    ]);
            });
    }
}
