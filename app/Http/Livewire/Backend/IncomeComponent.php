<?php

namespace App\Http\Livewire\Backend;

use App\Models\Income;
use Livewire\Component;
use function view;

class IncomeComponent extends Component
{

    public $incomes;

    public function render()
    {
        $this->incomes = Income::with(['contribution', 'user'])->get();

        return view('livewire.backend.incomes.index-component')
            ->layout('layouts.user', [
                'breadcrumbs' => [
                    [
                        'route' => 'backend.incomes',
                        'index' => 'Incomes Manager'
                    ],
                ]
            ]);
    }


}
