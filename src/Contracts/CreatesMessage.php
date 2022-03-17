<?php

namespace VojislavD\LaravelMessages\Contracts;

use VojislavD\LaravelMessages\Models\Thread;

interface CreatesMessage
{
    /**
     * @param \VojislavD\LaravelMessages\Models\Thread $thread
     * @param string $body
     * 
     * @return void
     */
    public function __invoke(Thread $thread, string $body);
}