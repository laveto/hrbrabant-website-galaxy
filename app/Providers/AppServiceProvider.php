<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // TODO Move to Galaxy
        setlocale(LC_TIME, 'nl_NL');

        // This Concord provider is not a real Service Provider and thus cannot be added to config/app.php['providers']!
        $this->app->register(ConcordServiceProvider::class);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
    }
}
