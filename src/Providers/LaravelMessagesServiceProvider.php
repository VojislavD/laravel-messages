<?php

namespace VojislavD\LaravelMessages\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use VojislavD\LaravelMessages\Http\Livewire\Inbox;
use VojislavD\LaravelMessages\Traits\Migrations;

class LaravelMessagesServiceProvider extends ServiceProvider
{
    use Migrations;

    /**
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * @return void
     */
    public function boot()
    {
        Livewire::component('inbox', Inbox::class);
        
        $this->loadViewsFrom(__DIR__.'/../../resources/views/livewire', 'laravel-messages');

        if ($this->app->runningInConsole()) {
            $this->publishes(
                $this->getMigrations()
            , 'laravel-messages-migrations');

            $this->publishes([
                __DIR__.'/../../config/messages.php' => config_path('messages.php')
            ], 'laravel-messages-config');

            $this->publishes([
                __DIR__.'/../../resources/views/livewire/inbox.blade.php' => resource_path('/views/vendor/laravel-messages/inbox.blade.php')
            ], 'laravel-messages-views');
        }
    }
}
