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
        $contributor = Contributor::find(4);
        $contribution = $contributor->contributions()->first();

        dd(
            Contributor::all(),
            $contribution->profits->sum('amount')
        );

        return view('livewire.testing-component')->layout('layouts.user');
    }
}
