<?php

namespace VojislavD\LaravelMessages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'thread_id',
        'user_id',
        'body',
        'seen_at'
    ];

    /**
     * @var array<int, string>
     */
    protected $touches = ['thread'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}