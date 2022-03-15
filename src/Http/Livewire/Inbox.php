<?php

namespace VojislavD\LaravelMessages\Http\Livewire;

use Livewire\Component;
use VojislavD\LaravelMessages\Contracts\CreatesMessage;
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
        'state.body' => 'body'
    ];

    public function mount()
    {
        $this->autoUpdate = config('messages.update.auto');
        $this->wirePoll = "wire:poll.".config('messages.update.time') ."ms";
    }

    public function rules()
    {
        return [
            'state.body' => ['required', 'string', 'max:5000', new FilterWords]
        ];
    }

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
