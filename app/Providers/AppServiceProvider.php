<?php

namespace App\Providers;

use App\Models\Anime;
use App\Models\Dorama;
use App\Observers\AnimeObserver;
use App\Observers\DoramaObserver;
use Illuminate\Pagination\Paginator;
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
        Anime::observe(AnimeObserver::class);
        Dorama::observe(DoramaObserver::class);
        Paginator::defaultView('pagination');
    }
}
