<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\toSay;
use App\Interfaces\UserInterface;
use App\Responstories\toDoProduct;
use App\Interfaces\ProductInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
          
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->singleton(
            ProductInterface::class,
            toDoProduct::class
          );
    }
}
