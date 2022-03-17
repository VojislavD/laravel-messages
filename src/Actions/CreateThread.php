<?php

namespace VojislavD\LaravelMessages\Actions;

use VojislavD\LaravelMessages\Contracts\CreatesThread;
use VojislavD\LaravelMessages\Models\Thread;
use VojislavD\LaravelMessages\Models\User;

class CreateThread implements CreatesThread
{
    public function __invoke(array $params)
    {
        $thread = Thread::create();

        $thread->users()->sync([
            auth()->id(),
            User::where('email', $params['email'])->first()->id
        ]);

        $thread->messages()->createMany([
            [
                'user_id' => auth()->id(),
                'body' => $params['body']
            ]
        ]);
    }
}