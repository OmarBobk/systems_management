<?php

namespace App\Http\Livewire\Backend;

use LivewireUI\Modal\ModalComponent;
use function view;

class TestingModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.backend.testing-modal')->layout('layouts.admin');
    }
}
