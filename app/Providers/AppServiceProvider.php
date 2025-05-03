<?php

namespace App\Providers;

use URL;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        // when user access from domain use https, if not use http
        if (request()->isSecure()) {
            URL::forceScheme('https');
        }

    }
}
