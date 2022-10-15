<?php

namespace App\Http\Livewire\Backend;

use App\Models\Contributor;
use Livewire\Component;
use function redirect;

class TestingComponent extends Component
{
    public function render()
    {

        $res = 0;
        $contributor = Contributor::all();

//        dd('fuck');
        $contribution = $contributor;

        return redirect()->route('cashier');

//        return view('livewire.backend.testing-component')->layout('layouts.user');
    }
}
