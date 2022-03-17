<?php

namespace VojislavD\LaravelMessages\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class)->oldest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function otherParticipant()
    {
        return $this->users()->whereNot('user_id', auth()->id());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function otherParticipantName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->otherParticipant()->first()->name
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function otherParticipantProfileImage(): Attribute
    {
        return new Attribute(
            get: fn () => $this->otherParticipant()->first()->profile_photo_url
        );
    }

    /**
     * @return int
     */
    public function unreadMessagesCount()
    {
        return $this->messages()
            ->where('user_id', '!=', auth()->id())
            ->whereNull('seen_at')
            ->count();
    }
}