<?php

namespace App\Providers;

use App\Events\RegisteredAndVerified;
use App\Events\SendNotification;
use App\Listeners\CreateAppNotification;
use App\Listeners\CreateMailNotification;
use App\Listeners\SendWelcomeEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SendNotification::class => [
            CreateAppNotification::class,
            CreateMailNotification::class
        ],
        Registered::class => [
            SendWelcomeEmailNotification::class,
            SendEmailVerificationNotification::class,
        ],
        RegisteredAndVerified::class => [
            SendWelcomeEmailNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
