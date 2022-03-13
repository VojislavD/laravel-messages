<?php

namespace VojislavD\LaravelMessages\Http\Livewire;

use Livewire\Component;

class Inbox extends Component
{
    public function render()
    {
        $threads = \App\Models\User::first()->threads()->with('otherParticipant')->get();

        return view('laravel-messages::inbox', [
            'threads' => $threads
        ]);
    }
}
