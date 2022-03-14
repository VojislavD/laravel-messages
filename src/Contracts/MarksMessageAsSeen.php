<?php

namespace VojislavD\LaravelMessages\Contracts;

use VojislavD\LaravelMessages\Models\Thread;

interface MarksMessageAsSeen
{
    public function __invoke(Thread $thread);
}