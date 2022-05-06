<?php

namespace App\Helpers;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class NotificationHelper
{
    public const MEDIA_TYPE_CHANNELS = [
        'Article' => 'articles',
        'Google Alert' => 'google_alerts',
        'News' => 'news',
        'Book' => 'books',
        'Podcast' => 'podcasts'
    ];

    public static function getType($object)
    {
        return get_class($object);
    }

    /**
     * @param \Illuminate\Notifications\Notification $notification
     * @return void
     */
    public static function sendAdminNotifications(Notification $notification)
    {
        $emailSettings = config('mail.custom.admin_notifications_email');
        $emailArray    = StringHelper::explodeAndFilterEmpty($emailSettings, ',');

        foreach ($emailArray as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                NotificationFacade::route('mail', $email)->notify($notification);
            }
        }

        if (config('services.slack.admin_notifications_enabled')) {
            NotificationFacade::route('slack', config('services.slack.webhooks.notifications'))->notify($notification);
        }
    }

    public static function sendSlackNotification(Notification $notification, string $channel)
    {
        if (config('services.slack.webhooks.' . $channel)) {
            NotificationFacade::route('slack', config('services.slack.webhooks.' . $channel))->notify($notification);
        }
    }

    public static function sendSalesNotifications(Notification $notification)
    {
        $emailSettings = config('mail.custom.sales_notifications_email');
        $emailArray    = StringHelper::explodeAndFilterEmpty($emailSettings, ',');

        foreach ($emailArray as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                NotificationFacade::route('mail', $email)->notify($notification);
            }
        }

        if (config('services.slack.admin_notifications_enabled')) {
            NotificationFacade::route('slack', config('services.slack.webhooks.sales_pipeline'))->notify($notification);
        }
    }
}
