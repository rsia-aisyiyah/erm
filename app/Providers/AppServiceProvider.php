<?php

namespace App\Providers;

use URL;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        /*
    |--------------------------------------------------------------------------
    | Dynamic URL Scheme
    |--------------------------------------------------------------------------
    | Lokal:
    | http://192.168.100.31/erm
    |
    | Production:
    | https://rsiap.my.id/erm
    |--------------------------------------------------------------------------
    */

        $host = request()->getHost();

        if ($host === 'rsiap.my.id') {
            URL::forceScheme('https');
        } else {
            URL::forceScheme('http');
        }

        /*
    |--------------------------------------------------------------------------
    | Log Viewer Authorization
    |--------------------------------------------------------------------------
    */

        LogViewer::auth(function ($request) {
            return session()->has('pegawai')
                && session()->get('pegawai')->nik === 'direksi';
        });
    }
}
