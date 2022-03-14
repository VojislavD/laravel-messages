<?php

namespace VojislavD\LaravelMessages;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use VojislavD\LaravelMessages\Contracts\CreatesMessage;
use VojislavD\LaravelMessages\Actions\CreateMessage;
use VojislavD\LaravelMessages\Actions\MarkMessageAsSeen;
use VojislavD\LaravelMessages\Contracts\MarksMessageAsSeen;
use VojislavD\LaravelMessages\Http\Livewire\Inbox;
use VojislavD\LaravelMessages\Traits\Migrations;

class LaravelMessagesServiceProvider extends ServiceProvider
{
    use Migrations;

    public $bindings = [
        CreatesMessage::class => CreateMessage::class,
        MarksMessageAsSeen::class => MarkMessageAsSeen::class
    ];

    public function register()
    {
        
    }

    public function boot()
    {
        Livewire::component('inbox', Inbox::class);
        
        $this->loadViewsFrom(__DIR__.'/../resources/views/livewire', 'laravel-messages');

        if ($this->app->runningInConsole()) {
                $this->publishes(
                    $this->getMigrations()
                , 'laravel-messages-migrations');
        }
    }
}
