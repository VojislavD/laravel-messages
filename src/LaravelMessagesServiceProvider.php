<?php

namespace VojislavD\LaravelMessages;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use VojislavD\LaravelMessages\Http\Livewire\Messages;

class LaravelMessagesServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        Livewire::component('messages', Messages::class);
        $this->loadViewsFrom(__DIR__.'/../resources/views/livewire', 'laravel-messages');
    }
}