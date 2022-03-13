<?php

namespace VojislavD\LaravelMessages\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Thread extends Model
{
    public function participiants()
    {
        return $this->belongsToMany(User::class, 'thread_participants');
    }

    public function otherParticipant()
    {
        return $this->participiants()->whereNot('user_id', auth()->id());
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
        return 2;
    }
}