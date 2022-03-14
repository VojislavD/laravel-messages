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
        $this->markMessagesAsSeen();

    }

    private function markMessagesAsSeen()
    {
        $this->thread->messages->each(function ($message) {
            $message->update([
                'seen' => now()
            ]);
        });
    }

    public function render()
    {
        $threads = auth()->user()->threads()->with('otherParticipant')->latest()->get();
        $messages = $this->thread?->messages->groupBy(fn ($message) => $message->created_at->format('Y-m-d'));

        return view('laravel-messages::inbox', [
            'threads' => $threads,
            'messages' => $messages
        ]);
    }
}
