<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SafeComponent extends Component
{
    public function render()
    {
        return view('livewire.safe-component')->layout('layouts.users');
    }
}
