<?php

namespace VojislavD\LaravelMessages;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use VojislavD\LaravelMessages\Http\Livewire\Inbox;

class LaravelMessagesServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        Livewire::component('inbox', Inbox::class);
        $this->loadViewsFrom(__DIR__.'/../resources/views/livewire', 'laravel-messages');
    }
}