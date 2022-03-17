<?php

namespace VojislavD\LaravelMessages\Contracts;

use VojislavD\LaravelMessages\Models\Thread;

interface MarksMessageAsSeen
{
    /**
     * @param \VojislavD\LaravelMessages\Models\Thread $thread
     * 
     * @return void
     */
    public function __invoke(Thread $thread);
}