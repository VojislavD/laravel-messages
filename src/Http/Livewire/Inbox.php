<?php

namespace VojislavD\LaravelMessages\Http\Livewire;

use Livewire\Component;

class Inbox extends Component
{
    public function render()
    {
        $threads = auth()->user()->threads()->with('otherParticipant')->get();

        return view('laravel-messages::inbox', [
            'threads' => $threads
        ]);
    }
}
