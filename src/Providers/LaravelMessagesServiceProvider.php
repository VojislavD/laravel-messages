<?php

namespace VojislavD\LaravelMessages\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use VojislavD\LaravelMessages\Http\Livewire\Inbox;
use VojislavD\LaravelMessages\Traits\Migrations;

class LaravelMessagesServiceProvider extends ServiceProvider
{
    use Migrations;

    public function register()
    {
        
    }

    public function boot()
    {
        Livewire::component('inbox', Inbox::class);
        
        $this->loadViewsFrom(__DIR__.'/../../resources/views/livewire', 'laravel-messages');

        if ($this->app->runningInConsole()) {
                $this->publishes(
                    $this->getMigrations()
                , 'laravel-messages-migrations');
        }
    }
}
