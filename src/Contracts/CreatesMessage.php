<?php

namespace VojislavD\LaravelMessages\Contracts;

use VojislavD\LaravelMessages\Models\Thread;

interface CreatesMessage
{
    public function __invoke(Thread $thread, string $body);
}