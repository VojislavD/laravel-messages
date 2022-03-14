<?php

namespace VojislavD\LaravelMessages\Http\Livewire;

use Livewire\Component;
use VojislavD\LaravelMessages\Models\Thread;

class Inbox extends Component
{
    public $thread;

    public function selectThread(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function render()
    {
        $threads = auth()->user()->threads()->with('otherParticipant')->latest()->get();
        $messages = $this->thread?->messages;

        return view('laravel-messages::inbox', [
            'threads' => $threads,
            'messages' => $messages
        ]);
    }
}
