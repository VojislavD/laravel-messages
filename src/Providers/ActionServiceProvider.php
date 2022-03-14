<?php

namespace VojislavD\LaravelMessages\Providers;

use VojislavD\LaravelMessages\Actions\CreateMessage;
use VojislavD\LaravelMessages\Actions\MarkMessageAsSeen;
use VojislavD\LaravelMessages\Contracts\CreatesMessage;
use VojislavD\LaravelMessages\Contracts\MarksMessageAsSeen;

class ActionServiceProvider extends LaravelMessagesServiceProvider
{
    public $bindings = [
        CreatesMessage::class => CreateMessage::class,
        MarksMessageAsSeen::class => MarkMessageAsSeen::class
    ];
}