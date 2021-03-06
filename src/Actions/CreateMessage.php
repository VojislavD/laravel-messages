<?php

namespace VojislavD\LaravelMessages\Actions;

use VojislavD\LaravelMessages\Contracts\CreatesMessage;
use VojislavD\LaravelMessages\Models\Message;
use VojislavD\LaravelMessages\Models\Thread;

class CreateMessage implements CreatesMessage
{
    /**
     * @param \VojislavD\LaravelMessages\Models\Thread $thread
     * @param string $body
     * 
     * @return void
     */
    public function __invoke(Thread $thread, string $body)
    {
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => auth()->user()->id,
            'body' => $body
        ]);
    }
}