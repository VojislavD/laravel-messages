<?php

namespace VojislavD\LaravelMessages\Providers;

use VojislavD\LaravelMessages\Actions\CreateMessage;
use VojislavD\LaravelMessages\Actions\CreateThread;
use VojislavD\LaravelMessages\Actions\MarkMessageAsSeen;
use VojislavD\LaravelMessages\Contracts\CreatesMessage;
use VojislavD\LaravelMessages\Contracts\CreatesThread;
use VojislavD\LaravelMessages\Contracts\MarksMessageAsSeen;

class ActionServiceProvider extends LaravelMessagesServiceProvider
{
    /**
     * @var array
     */
    public $bindings = [
        CreatesMessage::class => CreateMessage::class,
        MarksMessageAsSeen::class => MarkMessageAsSeen::class,
        CreatesThread::class => CreateThread::class
    ];
}