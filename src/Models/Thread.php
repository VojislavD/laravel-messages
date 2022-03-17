<?php

namespace VojislavD\LaravelMessages\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->oldest();
    }

    public function otherParticipant()
    {
        return $this->users()->whereNot('user_id', auth()->id());
    }

    public function otherParticipantName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->otherParticipant()->first()->name
        );
    }

    public function otherParticipantProfileImage(): Attribute
    {
        return new Attribute(
            get: fn () => $this->otherParticipant()->first()->profile_photo_url
        );
    }

    public function unreadMessagesCount()
    {
        return $this->messages
            ->where('user_id', '!=', auth()->id())
            ->whereNull('seen_at')
            ->count();
    }
}