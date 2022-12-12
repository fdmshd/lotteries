<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\SignUpUserListener;
use App\Events\SignUpUserEvent;
use App\Listeners\FinishMatchListener;
use App\Events\FinishMatchEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
        SignUpUserEvent::class => [
            SignUpUserListener::class,
        ],
        FinishMatchEvent::class => [
            FinishMatchListener::class,
        ],
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
