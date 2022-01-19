<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestingComponent extends Component
{
    public function render()
    {
        return view('livewire.testing-component')->layout('layouts.user');
    }
}
