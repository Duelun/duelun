<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use App\Http\Controllers\SupporterController;

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
        Blade::directive('icon', function ($expression) {
            return "<i class=\"fas fa-fw fa-{{ $expression }}\"></i>";
        });

        $supporters = app('App\Http\Controllers\SupporterController')->retrieveFrontend();
        view()->share('supporters', $supporters);
    }
}
