<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CardService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CardService::class, function() {
            return app(CardService::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
