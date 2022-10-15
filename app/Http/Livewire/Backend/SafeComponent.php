<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use function view;

class SafeComponent extends Component
{
    public function render()
    {
        return view('livewire.backend.safe-component')->layout('layouts.users');
    }
}
