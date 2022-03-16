<?php

namespace VojislavD\LaravelMessages\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use VojislavD\LaravelMessages\Models\Thread;

trait Messagable
{
    public function threads()
    {
        return $this->belongsToMany(Thread::class);
    }
}