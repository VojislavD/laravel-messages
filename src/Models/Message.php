<?php

namespace VojislavD\LaravelMessages\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}