<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use App\Models\Income;
use Livewire\Component;

class IncomeComponent extends Component
{

    public $incomes;

    public function render()
    {
        $this->incomes = Income::with(['contribution', 'user'])->get();



        return view('livewire.incomes.index-component')->layout('layouts.user');
    }
}
