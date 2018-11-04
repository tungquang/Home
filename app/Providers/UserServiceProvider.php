<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Responstories\toDoUser;
use App\Interfaces\UserInterface;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('view', UserInterface::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton(
        UserInterface::class,
        toDoUser::class
      );
    }
}
