<?php

namespace App\Providers;

use App\Events\NotificationCreated;
use App\Events\UserCreated;
use App\Listeners\NotificationCreatedListener;
use App\Listeners\UserNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {

        // Register for User Create Event
        Event::listen(
            UserCreated::class,
            [UserNotification::class, 'handle']
        );

        Event::listen(
            NotificationCreated::class,
            [NotificationCreatedListener::class, 'handle']
        );
    }
}
