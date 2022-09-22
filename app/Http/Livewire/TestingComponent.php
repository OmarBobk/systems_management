<?php

namespace App\Http\Livewire;

use App\Models\Contributor;
use App\Models\User;
use Livewire\Component;

class TestingComponent extends Component
{
    public function render()
    {

        $res = 0;
        $contributor = Contributor::all();

//        dd('fuck');
        $contribution = $contributor;

        return redirect()->route('cashier');

//        return view('livewire.testing-component')->layout('layouts.user');
    }
}
