<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Если композер реализуется при помощи класса:
        View::composer('profile', 'App\Http\ViewComposers\ProfileComposer');

        // Если композер реализуется в функции-замыкании:
        View::composer('dashboard', function()
        {

        });
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

}