<?php

namespace VojislavD\LaravelMessages;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use VojislavD\LaravelMessages\Contracts\CreatesMessage;
use VojislavD\LaravelMessages\Actions\CreateMessage;
use VojislavD\LaravelMessages\Actions\MarkMessageAsSeen;
use VojislavD\LaravelMessages\Contracts\MarksMessageAsSeen;
use VojislavD\LaravelMessages\Http\Livewire\Inbox;

class LaravelMessagesServiceProvider extends ServiceProvider
{
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

    private function getMigrations()
    {
        $existingMigrations = $this->existingMigrations();

        $migrations = [];

        if (! in_array('create_threads_table.php', $existingMigrations)) {
            $migrations[__DIR__.'/../database/migrations/create_threads_table.stub'] = database_path('migrations/'. date('Y_m_d_His', time()). '_create_threads_table.php');
        }

        if (! in_array('create_thread_participants_table.php', $existingMigrations)) {
            $migrations[__DIR__.'/../database/migrations/create_thread_participants_table.stub'] = database_path('migrations/'. date('Y_m_d_His', time()+1). '_create_thread_participants_table.php');
        }

        if (! in_array('create_messages_table.php', $existingMigrations)) {
            $migrations[__DIR__.'/../database/migrations/create_messages_table.stub'] = database_path('migrations/'. date('Y_m_d_His', time()+1). '_create_messages_table.php');
        }

        return $migrations;
    }
    
    private function existingMigrations()
    {
        $files = scandir(database_path('migrations'));

        $existingMigrations = [];

        foreach ($files as $file) {
            $existingMigrations[] = substr($file, 18, strlen($file) - 16);
        }

        return $existingMigrations;
    }
}