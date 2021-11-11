<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Models\Contribution;
use App\Models\Expense;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class BillComponent extends Component
{
    use WithPagination;

    // Edit & Create Bill.
    public $type, $amount, $description, $quantity, $serial, $seller_id, $contribution_id,
        $sellers, $contributions,
        $edit_method_name, $is_view_bill_actions, $is_edit;

    // Just for Create New Bill
    public $bills, $isCreateComponentOpen, $updateMode;

    // Edit Mode
    protected array $properties_rules = [
        'type'              => ['type.*'            => 'required|in:goods'],
        'quantity'          => ['quantity.*'        => 'required|integer'],
        'amount'            => ['amount.*'          => 'required|integer|min:1'],
        'serial'            => ['serial.*'          => 'required|integer|unique:bills,serial'],
        'seller_id'         => ['seller_id.*'       => 'required|integer'],
        'contribution_id'   => ['contribution_id.*' => 'required|integer'],
        'description'       => ['description.*'     => 'required'],
    ];

    // Edit Mode
    protected array $properties_message = [
        'type'              => [
            'type.*.required'             => 'This Field is required!',
            'type.*.in'                   => 'Please Choose another choice.'
        ],
        'quantity'          => [
            'quantity.*.required'          => 'This Field is required!',
            'quantity.*.integer'           => 'Quantity Should be integer'
        ],
        'amount'            => [
            'amount.*.required'            => 'This Field is required!',
            'amount.*.min'                 => 'Amount Can not be Less then 1!',
            'amount.*.integer'             => 'Amount Should be integer!',
        ],
        'serial'            => [
            'serial.*.required'            => 'This Field is required!',
            'serial.*.integer'             => 'Serial Should be integer!',
            'serial.*.unique'              => 'This Serial has been used!',
        ],
        'seller_id'         => [
            'seller_id.*.required'         => 'This Field is required!',
            'seller_id.*.integer'          => 'Please Choose an other value.'
        ],
        'contribution_id'   => [
            'contribution_id.*.required'   => 'This Field is required!',
            'contribution_id.*.integer'    => 'Please Choose an other value.'
        ],
        'description'       => ['description.*.required'     => 'This Field is required!'],
    ];

    // Create Mode
    protected array $create_properties_rules = [
        'type'                  => 'required|in:goods',
        'quantity'              => 'required|integer',
        'amount'                => 'required|integer|min:1',
        'serial'                => 'required|integer|unique:bills',
        'seller_id'             => 'required|integer',
        'contribution_id'       => 'required|integer',
        'description'           => 'required',
    ];

    // Create Mode
    protected array $create_properties_message = [
        'type.required'                   => 'This Field is required!',
        'type.in'                         => 'Please Choose another choice.',
        'quantity.required'               => 'This Field is required!',
        'quantity.integer'                => 'Quantity should be integer',
        'amount.required'                 => 'This Field is required!',
        'amount.min'                      => 'Amount Can not be Less then 1!',
        'amount.integer'                  => 'Amount Should be integer!',
        'serial.required'                 => 'This Field is required!',
        'serial.integer'                  => 'Serial Should be integer!',
        'serial.unique'                   => 'This Serial has been used!',
        'seller_id.required'              => 'This Field is required!',
        'seller_id.integer'               => 'Please Choose an other value.',
        'contribution_id.required'        => 'This Field is required!',
        'contribution_id.integer'         => 'Please Choose an other value.',
        'description.required'            => 'This Field is required!',
    ];

    public function mount()
    {
        $this->is_view_bill_actions  = [0 => false];
        $this->isCreateComponentOpen    = false;
        $this->updateMode               = false;

        $this->is_edit = [
            'type'              => [],
            'quantity'          => [],
            'amount'            => [],
            'description'       => [],
            'seller_id'         => [],
            'contribution_id'   => [],
            'serial'            => [],
        ];



    }

    public function render()
    {
        $this->bills = Bill::all();
        return view('livewire.bills.index-component')->layout('layouts.user');
    }

    public function create()
    {

        $this->contributions = Contribution::whereStatus(0)->get();
        $this->sellers       = Seller::all();

        $this->resetCreateComponent();
        $this->openCreateComponent();

    }

    public function store()
    {

        $now = Carbon::now();

        $this->validate($this->create_properties_rules, $this->create_properties_message);

        $bill = Bill::create([
            'created_at'            => $now,
            'type'                  => $this->type,
            'description'           => $this->description,
            'quantity'              => $this->quantity,
            'amount'                => $this->amount,
            'seller_id'             => $this->seller_id,
            'contribution_id'       => $this->contribution_id,
            'serial'                => $this->serial,
        ]);


        // Create New Expense After shopping bill.
        Expense::create([
            'created_at'       => $now,
            'type'             => 'shopping',
            'description'      => 'This Expense has been created Automatically After the new Bill.
            ',
            'amount'           => $this->amount,
            'user_id'          => Auth::user()->id,
            'bill_id'          => $bill->id,
            'contribution_id'  => $this->contribution_id,
        ]);

        // Update Contribution that used to buy this bill.
        Contribution::find($this->contribution_id)
            ->decrement('amount', $this->amount);

        session()->flash('message', 'Bill Created');
        session()->flash('alert' , 'success');

        $this->closeCreateComponent();
        $this->resetCreateComponent();

    }


    public function openCreateComponent()
    {
        $this->isCreateComponentOpen = true;
        $this->updateMode            = true;
    }

    public function closeCreateComponent()
    {
        $this->isCreateComponentOpen = false;
        $this->updateMode            = false;
    }

    public function resetCreateComponent()
    {
        $this->reset('type', 'serial', 'updateMode', 'seller_id', 'amount', 'quantity', 'description', 'contribution_id');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function editNew(Bill $bill, $propertyName)
    {
        $this->closeCreateComponent();
        $this->is_edit = [
            'type'               => [],
            'quantity'           => [],
            'amount'             => [],
            'description'        => [],
            'seller_id'          => [],
            'contribution_id'    => [],
            'serial'             => [],
        ];
        $this->{$propertyName}[$bill->id]          = $bill->{$propertyName};
        $this->is_edit[$propertyName][$bill->id]   = true;
        $this->is_view_bill_actions                = [];
        $this->is_view_bill_actions[$bill->id]     = true;
        $this->edit_method_name                    = $propertyName;
    }

    public function updateNew(Bill $bill, $propertyName)
    {
        $this->validate(
            [$propertyName.'.'.$bill->id => $this->properties_rules[$propertyName][$propertyName.'.*']],
            $this->properties_message[$propertyName]
        );

        $bill->update([$propertyName => $this->{$propertyName}[$bill->id]]);
        $this->closeEdit($bill->id, $propertyName);
    }

    public function closeEdit($id, $propertyName)
    {
        $this->is_edit[$propertyName][$id]          = false;
        $this->is_view_bill_actions[$id]            = false;
    }


    /**
     * Validate Data in realtime.
     *
     * @param $propertyName
     * @throws ValidationException
     */
    public function updated($propertyName)
    {
        if ($this->updateMode) {

            $this->validateOnly($propertyName, $this->create_properties_rules, $this->create_properties_message);
        } else {
            $name = explode('.', $propertyName)[0];

            $this->validateOnly($propertyName, $this->properties_rules[$name], $this->properties_message[$name]);
        }
    }

    public function delete(int $id)
    {
        Bill::find($id)->delete();
        session()->flash('message', 'Bill deleted.');
        session()->flash('alert', 'success');
    }


}
