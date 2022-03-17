<?php

namespace VojislavD\LaravelMessages\Traits;

use VojislavD\LaravelMessages\Models\Thread;

trait Messagable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function threads()
    {
        return $this->belongsToMany(Thread::class);
    }
}