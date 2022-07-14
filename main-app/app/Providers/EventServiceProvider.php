<?php

namespace App\Providers;

use App\Jobs\CreateProductJob;
use App\Jobs\DeleteProductJob;
use App\Jobs\TestJob;
use App\Jobs\UpdateProductJob;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        \App::bindMethod(CreateProductJob::class. '@handle', fn($job) => $job->handle());
        \App::bindMethod(UpdateProductJob::class. '@handle', fn($job) => $job->handle());
        \App::bindMethod(DeleteProductJob::class. '@handle', fn($job) => $job->handle());
    }

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
