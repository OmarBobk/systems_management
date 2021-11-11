<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TestingModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.testing-modal')->layout('layouts.admin');
    }
}
