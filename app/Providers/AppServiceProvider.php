<?php

namespace App\Providers;

use App\Link;
use App\Observers\LinkObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Link::observe(LinkObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
