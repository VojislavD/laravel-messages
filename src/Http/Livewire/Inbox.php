<?php

namespace VojislavD\LaravelMessages\Http\Livewire;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use VojislavD\LaravelMessages\Contracts\CreatesMessage;
use VojislavD\LaravelMessages\Contracts\CreatesThread;
use VojislavD\LaravelMessages\Contracts\MarksMessageAsSeen;
use VojislavD\LaravelMessages\Models\Thread;
use VojislavD\LaravelMessages\Rules\FilterWords;

class Inbox extends Component
{
    /**
     * @var bool
     */
    public $autoUpdate;

    /**
     * @var string
     */
    public $wirePoll;

    /**
     * @var \VojislavD\LaravelMessages\Models\Thread
     */
    public $thread;
    
    /**
     * @var array<string, string>
     */
    public $state = [];

    /**
     * @var array<string, string>
     */
    protected $listeners = ['refreshComponent' => '$refresh'];

    /**
     * @var array<string, string>
     */
    protected $validationAttributes = [
        'state.body' => 'body',
        'state.email' => 'email'
    ];

    /**
     * @var array<string, string>
     */
    protected $messages = [
        'state.email.exists' => 'User with that email address does not exists.',
    ];

    /**
     * @return void
     */
    public function mount()
    {
        $this->autoUpdate = config('messages.update.auto');
        $this->wirePoll = "wire:poll.".config('messages.update.time') ."ms";
    }

    /**
     * @param \VojislavD\LaravelMessages\Models\Thread $thread
     * @param \VojislavD\LaravelMessages\Contracts\MarksMessageAsSeen $updater
     * 
     * @return void
     */
    public function selectThread(Thread $thread, MarksMessageAsSeen $updater)
    {
        $this->resetErrorBag();

        $this->thread = $thread;

        $updater($thread);
    }

    /**
     * @param \VojislavD\LaravelMessages\Contracts\CreatesMessage $creator
     * 
     * @return void
     */
    public function submit(CreatesMessage $creator)
    {
        $this->validate([
            'state.body' => ['required', 'string', 'max:5000', new FilterWords]
        ]);

        $creator($this->thread, $this->state['body']);

        $this->reset(['state']);

        $this->emit('refreshComponent');
    }

    /**
     * @param \VojislavD\LaravelMessages\Contracts\CreatesThread $creator
     * 
     * @return void
     */
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

    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
