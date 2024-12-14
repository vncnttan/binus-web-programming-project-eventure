<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();

        Gate::define('organizer-privilege', function ($user) {
            return $user->role === 'organizer';
        });

        Gate::define('participant-privilege', function ($user) {
            return $user->role === 'participant';
        });

        Gate::define('event-creator-privilege', function ($user, $event) {
            return $user->id === $event->user_id;
        });
    }
}
