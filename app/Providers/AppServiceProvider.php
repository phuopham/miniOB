<?php

namespace App\Providers;

use App\Models\cart;
use Illuminate\Support\ServiceProvider;
use View;

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
        View::composer('layouts.footer', function ($view) {
            $cart = cart::find(1); // retrieve cart information
            $view->with('cart', $cart);
        });
    }
}
