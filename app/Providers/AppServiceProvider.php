<?php

namespace App\Providers;

use App\Models\kas;
use App\Observers\KasObserver;
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
        kas::observe(KasObserver::class);
    }
}
