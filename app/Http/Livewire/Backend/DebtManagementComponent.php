<?php

namespace App\Http\Livewire\Backend;

use App\Models\Debt;
use App\Models\Debtor;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function session;
use function view;

class DebtManagementComponent extends Component
{

    public $searchKeyword, $debtors, $results, $editName, $editPhone, $name, $phone, $is_view_debts;
    public $is_debt_name, $is_debt_description, $is_debt_cost, $is_debt_price, $is_debt_paid, $is_debt_due, $is_debt_amount;
    public $debt_name, $debt_description, $debt_cost, $debt_price, $debt_paid, $debt_due, $debt_amount;
    public $is_show_debts_from_search, $is_create_new_debtor, $is_create_new_debt;
    public $newDebtorName, $newDebtorPhone;
    public $new_debt_name, $new_debt_description, $new_debt_cost, $new_debt_price, $new_debt_paid, $new_debt_due, $new_debt_product_id, $new_debt_amount;
    public $productSearchKeyword, $productSearchResult;
    public $is_view_debts_from_search_form, $breadcrumbs;

    protected array $rules = [
        'newDebtorName'  => 'required',
        'newDebtorPhone' => 'required',
    ];

    public function render()
    {
        $this->testing = [
            'alert-message' => 'primary',
            'action'        => 'viewDebts',
            'icon'          => 'bold-down',
        ];
        $this->debtors = Debtor::all();

        $this->breadcrumbs = [
            [
                'route' => 'backend.debts',
                'index' => 'Debts Manager'
            ],
        ];

        return view('livewire.backend.debts.debt-management-component')
            ->layout('layouts.user', ['breadcrumbs' => $this->breadcrumbs]);
    }

    /**
     * Search For a Debtor
     */
    public function updatedSearchKeyword()
    {
        $this->results = Debtor::where("name", "like", "%$this->searchKeyword%")->withSum('debts', 'price')->orderBy('id')->get();
    }

    /**
     * Search For a Product
     */
    public function updatedProductSearchKeyword()
    {
        $this->productSearchResult = Product::where("serial", "like", "%$this->productSearchKeyword%")
            ->orderBy('id')->get();
    }

    /**
     * Toggle view Debts table.
     *
     * @param $id
     */
    public function viewDebts($id)
    {
        $this->is_view_debts = (isset($this->is_view_debts))
            ? (isset($this->is_view_debts[$id])
                ? (($this->is_view_debts[$id])
                    ? [$id => false]
                    : [$id => true])
                : [$id => true])
            : [$id => false];

    }

    /**
     * Toggle view Debts table.
     *
     * @param $id
     */
    public function viewDebtFromSearchForm($id)
    {
    $this->is_view_debts_from_search_form = (isset($this->is_view_debts_from_search_form))
        ? (isset($this->is_view_debts_from_search_form[$id])
            ? (($this->is_view_debts_from_search_form[$id])
                ? [$id => false]
                : [$id => true])
            : [$id => true])
        : [$id => false];

    }

    /**
     * view Debtor and his debts table next user
     * find him by searching and clicking on debtor name.
     *
     * @param Debtor $debtor
     */
    public function showDebtsFromSearch(Debtor $debtor)
    {
        $this->is_show_debts_from_search = [];
        $this->is_show_debts_from_search[$debtor->id] = true;
    }

    /**
     * Edit Debtor Name
     *
     * @param Debtor $debtor
     */
    public function editName(Debtor $debtor)
    {
        $this->editName = [$debtor->id => true];
        $this->editPhone = [$debtor->id => false];
        $this->name[$debtor->id] = $debtor->name;
    }

    /**
     * Update Debtor Name
     *
     * @param Debtor $debtor
     */
    public function updateNameEnter(Debtor $debtor)
    {
        $debtor->update(['name' => $this->name[$debtor->id]]);
        $this->editName = [$debtor->id => false];
    }

    /**
     * Close The Edit Debtor Name
     *
     * @param $id
     */
    public function closeUpdateNameEnter($id)
    {
        $this->editName = [$id => false];
    }



    /**
     * Edit Debtor Phone Number
     * @param Debtor $debtor
     */
    public function editPhone(Debtor $debtor)
    {
        $this->editName = [$debtor->id => false];
        $this->editPhone = [$debtor->id => true];
        $this->phone[$debtor->id] = $debtor->phone;
    }

    /**
     * Update Debtor Phone Number
     *
     * @param Debtor $debtor
     */
    public function updatePhoneEnter(Debtor $debtor)
    {
        $debtor->update(['phone' => $this->phone[$debtor->id]]);
        $this->editPhone = [$debtor->id => false];
    }

    /**
     * Close The Edit Debtor Phone Number
     *
     * @param $id
     */
    public function closeUpdatePhoneEnter($id)
    {
        $this->editPhone = [$id => false];
    }



    public function editItemName($id, Debt $debt)
    {
        $this->determineWhatToEdit($id, $debt->id, 'item_name');
        $this->debt_name[$id][$debt->id]    = $debt->item_name;
    }

    public function updateDebtItemName($id, Debt $debt)
    {
        $debt->update(['item_name' => $this->debt_name[$id][$debt->id]]);
        $this->is_debt_name = [$id => [$debt->id => false]];
    }

    public function closeItemName($debtor_id, $debt_id)
    {
        $this->is_debt_name = [$debtor_id => [$debt_id => false]];
    }



    public function editDescription($id, Debt $debt)
    {
        $this->determineWhatToEdit($id, $debt->id, 'description');
        $this->debt_description[$id][$debt->id]    = $debt->description;
    }

    public function updateDebtDescription($id, Debt $debt)
    {
        $debt->update(['description' => $this->debt_description[$id][$debt->id]]);
        $this->is_debt_description = [$id => [$debt->id => false]];
    }

    public function closeDescription($debtor_id, $debt_id)
    {
        $this->is_debt_description = [$debtor_id => [$debt_id => false]];
    }



    public function editCost($id, Debt $debt)
    {
        $this->determineWhatToEdit($id, $debt->id, 'cost');
        $this->debt_cost[$id][$debt->id]    = $debt->cost * $debt->amount;
    }

    public function updateDebtCost($id, Debt $debt)
    {
        $debt->update(['cost' => $this->debt_cost[$id][$debt->id]]);
        $this->is_debt_cost = [$id => [$debt->id => false]];
    }

    public function closeCost($debtor_id, $debt_id)
    {
        $this->is_debt_cost = [$debtor_id => [$debt_id => false]];
    }



    public function editPrice($id, Debt $debt)
    {
        $this->determineWhatToEdit($id, $debt->id, 'price');
        $this->debt_price[$id][$debt->id]   = $debt->price * $debt->amount;
    }

    public function updateDebtPrice($id, Debt $debt)
    {
        $debt->update(['price' => $this->debt_price[$id][$debt->id]]);
        $this->is_debt_price = [$id => [$debt->id => false]];
    }

    public function closePrice($debtor_id, $debt_id)
    {
        $this->is_debt_price = [$debtor_id => [$debt_id => false]];
    }



    public function editAmount($id, Debt $debt)
    {
        $this->determineWhatToEdit($id, $debt->id, 'amount');
        $this->debt_amount[$id][$debt->id]  = $debt->amount;
    }

    public function updateDebtAmount($id, Debt $debt)
    {
        $debt->update(['amount' => $this->debt_amount[$id][$debt->id]]);
        $this->is_debt_amount = [$id => [$debt->id => false]];
    }

    public function closeAmount($debtor_id, $debt_id)
    {
        $this->is_debt_amount = [$debtor_id => [$debt_id => false]];
    }



    public function editPaid($id, Debt $debt)
    {
        $this->determineWhatToEdit($id, $debt->id, 'paid');
        $this->debt_paid[$id][$debt->id]    = $debt->paid;
    }

    public function updatePaid(Debt $debt)
    {
        $debt->update(['is_paid' => !$debt->is_paid]);
    }

    public function closePaid($debtor_id, $debt_id)
    {
        $this->is_debt_paid = [$debtor_id => [$debt_id => false]];
    }



    public function addNewDebtor()
    {
        $this->resetCreateNewDebtorForm();
        $this->is_create_new_debtor = true;
    }

    public function store()
    {

        $this->validate();

        Debtor::create([
            'name'        => $this->newDebtorName,
            'phone'       => $this->newDebtorPhone,
            'user_id'     => Auth::user()->id,
        ]);

        session()->flash('message', 'Debtor Created');
        session()->flash('alert' , 'success');

        $this->closeCreateDebtorComponent();
        $this->resetCreateNewDebtorForm();

    }

    public function closeCreateDebtorComponent()
    {
        $this->is_create_new_debtor = false;
    }

    public function resetCreateNewDebtorForm()
    {
        $this->reset('newDebtorName', 'newDebtorPhone');
    }



    public function createNewDebt($id)
    {
        $this->resetCreateNewDebtForm();
        $this->is_create_new_debt = [$id => true];
    }

    public function storeDebt($debtor_id)
    {
        $this->validate([
            'new_debt_name'          => 'required',
            'new_debt_cost'          => 'required|integer',
            'new_debt_price'         => 'required|integer',
            'new_debt_due'           => 'required',
            'new_debt_product_id'    => 'required',
        ]);

        Debt::create([
            'item_name'     => $this->new_debt_name,
            'description'   => $this->new_debt_description,
            'cost'          => $this->new_debt_cost,
            'price'         => $this->new_debt_price,
            'amount'        => $this->new_debt_amount,
            'is_paid'       => 0,
            'due'           => $this->new_debt_due,
            'product_id'    => $this->new_debt_product_id,
            'debtor_id'     => $debtor_id,
        ]);

        session()->flash('message', 'Debt Created');
        session()->flash('alert' , 'success');

        $this->closeCreateDebtComponent();
        $this->resetCreateNewDebtForm();

    }

    public function fillProductToDebt(Product $product)
    {
        $this->new_debt_name        = $product->name;
        $this->new_debt_cost        = $product->cost;
        $this->new_debt_price       = $product->price;
        $this->new_debt_product_id  = $product->id;
        $this->productSearchKeyword = '';
    }

    public function closeCreateDebtComponent()
    {
        $this->is_create_new_debt = false;
    }

    public function resetCreateNewDebtForm()
    {
        $this->reset('new_debt_name', 'new_debt_description', 'new_debt_cost', 'new_debt_price', 'new_debt_paid', 'new_debt_due', 'new_debt_product_id', 'new_debt_amount');
    }



    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }


    /**
     * Helper function
     * @param $debtor_id
     * @param Debt $debt
     */
    public function determineWhatToUpdate($debtor_id, Debt $debt)
    {
        $available_methods = [
            $this->is_debt_name        [$debtor_id][$debt->id] => 'updateDebtItemName',
            $this->is_debt_description [$debtor_id][$debt->id] => 'updateDebtDescription',
            $this->is_debt_cost        [$debtor_id][$debt->id] => 'updateDebtCost',
            $this->is_debt_price       [$debtor_id][$debt->id] => 'updateDebtPrice',
            $this->is_debt_amount      [$debtor_id][$debt->id] => 'updateDebtAmount',
        ];

        // calling the method
        $this->{$available_methods[1]}($debtor_id, $debt);

    }

    /**
     * Helper function
     * @param $debtor_id
     * @param $debt_id
     */
    public function determineWhatToClose($debtor_id, $debt_id)
    {
        $available_methods = [
            $this->is_debt_name        [$debtor_id][$debt_id] => 'closeItemName',
            $this->is_debt_description [$debtor_id][$debt_id] => 'closeDescription',
            $this->is_debt_cost        [$debtor_id][$debt_id] => 'closeCost',
            $this->is_debt_price       [$debtor_id][$debt_id] => 'closePrice',
            $this->is_debt_amount      [$debtor_id][$debt_id] => 'closeAmount',
        ];

        // calling the method
        $this->{$available_methods[1]}($debtor_id, $debt_id);

    }

    public function determineWhatToEdit($debtor_id, $debt_id, $field)
    {
        $name           = [$debtor_id => [$debt_id => false]];
        $description    = [$debtor_id => [$debt_id => false]];
        $cost           = [$debtor_id => [$debt_id => false]];
        $price          = [$debtor_id => [$debt_id => false]];
        $paid           = [$debtor_id => [$debt_id => false]];
        $due            = [$debtor_id => [$debt_id => false]];
        $amount         = [$debtor_id => [$debt_id => false]];

        $$field         = [$debtor_id => [$debt_id => true]];

        $this->is_debt_name                 = $name;
        $this->is_debt_description          = $description;
        $this->is_debt_cost                 = $cost;
        $this->is_debt_price                = $price;
        $this->is_debt_paid                 = $paid;
        $this->is_debt_due                  = $due;
        $this->is_debt_amount               = $amount;

    }

    public function test()
    {
        $x = [
            2 => 3,

        ];
    }

}
