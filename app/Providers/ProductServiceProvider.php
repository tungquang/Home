<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Responstories\toDoProduct;
use App\Interfaces\ProductInterface;


class ProductServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
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
