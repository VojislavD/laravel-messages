<?php

namespace VojislavD\LaravelMessages\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use VojislavD\LaravelMessages\Models\Thread;

trait Messagable
{
    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'thread_participants');
    }
}