<?php

namespace VojislavD\LaravelMessages\Http\Livewire;

use Livewire\Component;
use VojislavD\LaravelMessages\Contracts\CreatesMessage;
use VojislavD\LaravelMessages\Contracts\CreatesThread;
use VojislavD\LaravelMessages\Contracts\MarksMessageAsSeen;
use VojislavD\LaravelMessages\Models\Thread;
use VojislavD\LaravelMessages\Rules\FilterWords;

class Inbox extends Component
{
    public $autoUpdate;

    public $wirePoll;

    public $thread;
    
    public $state = [];

    protected $listeners = ['refreshComponent' => '$refresh'];

    protected $validationAttributes = [
        'state.body' => 'body',
        'state.email' => 'email'
    ];

    protected $messages = [
        'state.email.exists' => 'User with that email address does not exists.',
    ];

    public function mount()
    {
        $this->autoUpdate = config('messages.update.auto');
        $this->wirePoll = "wire:poll.".config('messages.update.time') ."ms";
    }

    public function selectThread(Thread $thread, MarksMessageAsSeen $updater)
    {
        $this->resetErrorBag();

        $this->thread = $thread;

        $updater($thread);
    }

    public function submit(CreatesMessage $creator)
    {
        $this->validate([
            'state.body' => ['required', 'string', 'max:5000', new FilterWords]
        ]);

        $creator($this->thread, $this->state['body']);

        $this->reset(['state']);

        $this->emit('refreshComponent');
    }

    public function newMessageSubmit(CreatesThread $creator)
    {
        $this->validate([
            'state.email' => ['required', 'email', 'exists:users,email'],
            'state.body' => ['required', 'string', 'max:5000', new FilterWords]
        ]);

        $creator($this->state);

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
