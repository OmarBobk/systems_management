<?php

namespace App\Http\Livewire;

use App\Models\Contributor;
use App\Models\Expense;
use App\Models\Contribution;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpensesComponent extends Component
{

    public $expenses, $editType, $editDescription, $editAmount, $editContributionId;
    public $type, $description, $amount, $contribution_id;
    public $contributors;

    public $is_create_new_expense;

    public function render()
    {
        $this->expenses = Expense::with(['contribution', 'user'])->get();

        $this->contributors = Contributor::all();


        return view('livewire.expenses.index-component')->layout('layouts.user');
    }

    /**
     * Edit Expense Type
     *
     * @param Expense $expense
     */
    public function editType(Expense $expense)
    {
        $this->editType               = [$expense->id => true];
        $this->editDescription        = [$expense->id => false];
        $this->editAmount             = [$expense->id => false];
        $this->editContributionId     = [$expense->id => false];
        $this->type[$expense->id]     = $expense->type;
    }

    /**
     * Update Expense Type
     *
     * @param Expense $expense
     */
    public function updateTypeEnter(Expense $expense)
    {
        $expense->update(['type' => $this->type[$expense->id]]);
        $this->editType = [$expense->id => false];
    }

    /**
     * Close The Edit Expense Type
     *
     * @param $id
     */
    public function closeUpdateTypeEnter($id)
    {
        $this->editType = [$id => false];
    }



    /**
     * Edit Expense Description Number
     * @param Expense $expense
     */
    public function editDescription(Expense $expense)
    {
        $this->editType                  = [$expense->id => false];
        $this->editDescription           = [$expense->id => true];
        $this->editAmount                = [$expense->id => false];
        $this->editContributionId        = [$expense->id => false];
        $this->description[$expense->id] = $expense->description;
    }

    /**
     * Update Expense Description Number
     *
     * @param Expense $expense
     */
    public function updateDescriptionEnter(Expense $expense)
    {
        $expense->update(['description' => $this->description[$expense->id]]);
        $this->editDescription = [$expense->id => false];
    }

    /**
     * Close The Edit Expense Description Number
     *
     * @param $id
     */
    public function closeUpdateDescriptionEnter($id)
    {
        $this->editDescription = [$id => false];
    }



    /**
     * Edit Expense Amount Number
     * @param Expense $expense
     */
    public function editAmount(Expense $expense)
    {
        $this->editType               = [$expense->id => false];
        $this->editDescription        = [$expense->id => false];
        $this->editAmount             = [$expense->id => true];
        $this->editContributionId     = [$expense->id => false];
        $this->amount[$expense->id]   = $expense->amount;
    }

    /**
     * Update Expense Amount Number
     *
     * @param Expense $expense
     */
    public function updateAmountEnter(Expense $expense)
    {
        $expense->update(['amount' => $this->amount[$expense->id]]);
        $this->editAmount = [$expense->id => false];
    }

    /**
     * Close The Edit Expense Amount Number
     *
     * @param $id
     */
    public function closeUpdateAmountEnter($id)
    {
        $this->editAmount = [$id => false];
    }



    /**
     * Edit Expense ContributionId Number
     * @param Expense $expense
     */
    public function editContributionId(Expense $expense)
    {
        $this->editType                        = [$expense->id => false];
        $this->editDescription                 = [$expense->id => false];
        $this->editContributionId              = [$expense->id => true];
        $this->editAmount                      = [$expense->id => false];
        $this->contribution_id[$expense->id]   = $expense->contribution_id;
    }

    /**
     * Update Expense ContributionId Number
     *
     * @param Expense $expense
     */
    public function updateContributionIdEnter(Expense $expense)
    {
        $expense->update(['contribution_id' => $this->contribution_id[$expense->id]]);
        $this->editContributionId = [$expense->id => false];
    }

    /**
     * Close The Edit Expense ContributionId Number
     *
     * @param $id
     */
    public function closeUpdateContributionIdEnter($id)
    {
        $this->editContributionId = [$id => false];
    }



    public function addNewExpense()
    {
        $this->resetCreateNewExpenseForm();
        $this->is_create_new_expense = true;
    }

    public function storeExpense()
    {
        $now = Carbon::now();

        $this->validate([
            'type'             => 'required',
            'description'      => 'required',
            'amount'           => 'required',
            'contribution_id'  => 'required',
        ]);

        Expense::create([
            'type'              => $this->type,
            'description'       => $this->description,
            'amount'            => $this->amount,
            'user_id'           => Auth::user()->id,
            'contribution_id'   => $this->contribution_id,
            'created_at'        => $now,
            'updated_at'        => $now,
        ]);

        session()->flash('message', 'Expense Created');
        session()->flash('alert' , 'success');

        $this->closeCreateExpenseComponent();
        $this->resetCreateNewExpenseForm();

    }

    public function closeCreateExpenseComponent()
    {
        $this->is_create_new_expense = false;
    }

    public function resetCreateNewExpenseForm()
    {
        $this->reset('type', 'description', 'amount', 'contribution_id');
    }


    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
