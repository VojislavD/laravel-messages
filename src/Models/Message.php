<?php

namespace VojislavD\LaravelMessages\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'thread_id',
        'user_id',
        'body',
        'seen_at'
    ];
    
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}