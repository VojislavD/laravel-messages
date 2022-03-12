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

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateConversationsTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/create_conversations_table.stub' => database_path('migrations/'. date('Y_m_d_His', time()). '_create_conversations_table.php'),  
                ], 'laravel-messages-migrations');
            }
        }
    }
}