<?php

namespace VojislavD\LaravelMessages\Http\Livewire;

use Livewire\Component;

class Messages extends Component
{
    public function render()
    {
        return view('laravel-messages::messages');
    }
}
