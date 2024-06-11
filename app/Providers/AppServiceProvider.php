<?php

namespace App\Providers;

use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
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

        Gate::define('admin', function () {
            $arrayAdmin = ['direksi', 'DIR'];
            return session()->get('pegawai')->nik == 'direksi' ||
                in_array(session()->get('pegawai')->departement, $arrayAdmin);
        });

        // Gate::define('admin', function () {
        //     $arrayAdmin = ['direksi', 'DIR'];
        //     return session()->get('pegawai')->nik == 'direksi' ||
        //         in_array(session()->get('pegawai')->departement, $arrayAdmin);
        // });
    }
}
