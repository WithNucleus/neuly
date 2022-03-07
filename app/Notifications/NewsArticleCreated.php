<?php

namespace App\Notifications;

use App\Models\NewsArticle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class NewsArticleCreated extends Notification
{
    use Queueable;

    private $news_article;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(NewsArticle $news_article)
    {
        $this->news_article = $news_article;
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
        //$url = route('discover.events.show', $this->event->slug);
        $adminUrl = route('event.show', $this->news_article->id);

        return (new SlackMessage)->content('A new news article was created: ' . $this->news_article->name)
            /*->attachment(function ($attachment) use ($url) {
                $attachment->title('Show news article', $url)
                    ->fields([
                        'News Article' => $this->news_article->name
                    ]);
            })*/
            ->attachment(function ($attachment) use ($adminUrl) {
                $attachment->title('Administrate news article', $adminUrl)
                    ->fields([
                        'News Article' => $this->news_article->name
                    ]);
            });
    }
}
