<?php

namespace VojislavD\LaravelMessages\Http\Livewire;

use Livewire\Component;
use VojislavD\LaravelMessages\Contracts\CreatesMessage;
use VojislavD\LaravelMessages\Contracts\MarksMessageAsSeen;
use VojislavD\LaravelMessages\Models\Message;
use VojislavD\LaravelMessages\Models\Thread;

class Inbox extends Component
{
    public $thread;

    public $state = [];

    protected $listeners = ['refreshComponent' => '$refresh'];

    protected $rules = [
        'state.body' => ['required', 'string', 'max:5000']
    ];

    protected $validationAttributes = [
        'state.body' => 'body'
    ];

    public function selectThread(Thread $thread, MarksMessageAsSeen $updater)
    {
        $this->thread = $thread;

        $updater($thread);
    }

    public function submit(CreatesMessage $creator)
    {
        $this->validate();

        $creator($this->thread, $this->state['body']);

        $this->reset(['state']);

        $this->emit('refreshComponent');
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
