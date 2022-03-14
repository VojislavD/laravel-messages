<?php

namespace VojislavD\LaravelMessages\Http\Livewire;

use Livewire\Component;
use VojislavD\LaravelMessages\Models\Message;
use VojislavD\LaravelMessages\Models\Thread;

class Inbox extends Component
{
    public $thread;

    public $state = [];

    protected $rules = [
        'state.body' => ['required']
    ];

    protected $validationAttributes = [
        'state.body' => 'body'
    ];

    public function selectThread(Thread $thread)
    {
        $this->thread = $thread;
        $this->markMessagesAsSeen();

    }

    private function markMessagesAsSeen()
    {
        $this->thread
            ->messages
            ->where('user_id', '!=', auth()->id())
            ->each(function ($message) {
            $message->update([
                'seen' => now()
            ]);
        });
    }

    public function submit()
    {
        $this->validate();

        Message::create([
            'thread_id' => $this->thread->id,
            'user_id' => auth()->user()->id,
            'body' => $this->state['body']
        ]);

        $this->reset(['state']);
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
