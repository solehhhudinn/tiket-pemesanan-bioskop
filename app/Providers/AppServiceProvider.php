<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        $timezone = Config::get('app.timezone', 'UTC');
        date_default_timezone_set($timezone);
        Carbon::setLocale(config('app.locale'));

        View::composer('layouts.app', function ($view) {
            $user = Auth::user();
            $unreadNotifications = $user ? $user->unreadNotifications : collect();
            $view->with('unreadNotifications', $unreadNotifications);
        });

    }
}
