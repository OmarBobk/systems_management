<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TestingComponent extends Component
{
    public function render()
    {
        dd(collect(User::query()
            ->with('products')
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at->toFormattedDateString(),
            ]))->all()['data'],
            User::query()
                ->with('products')
                ->paginate(10)
                ->withQueryString());

        return view('livewire.testing-component')->layout('layouts.user');
    }
}
