<?php

namespace VojislavD\LaravelMessages\Actions;

use VojislavD\LaravelMessages\Contracts\MarksMessageAsSeen;
use VojislavD\LaravelMessages\Models\Thread;

class MarkMessageAsSeen implements MarksMessageAsSeen
{
    public function __invoke(Thread $thread)
    {
        $thread
            ->messages
            ->where('user_id', '!=', auth()->id())
            ->each(function ($message) {
                $message->update([
                    'seen_at' => now()
                ]);
            });
    }
}