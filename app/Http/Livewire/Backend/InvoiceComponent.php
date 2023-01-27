<?php

namespace App\Http\Livewire\Backend;

use App\Models\Invoice;
use App\Models\Invoicecustomer;
use App\Models\Invoicerecord;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceComponent extends Component
{
    use JsonRespondController, WithPagination;
    public $searchKeyword = '';
    protected $queryString = [
        'searchKeyword' => ['except' => '']
    ];

    public $fields, $breadcrumbs;
    public $orderByColumn;
    public $create_customer_name, $create_customer_phone;

    // invoice
    public $create_invoice_serial;

    // record
    public $create_record_name, $create_record_cost, $create_record_price, $create_record_serial;
    public $is_create_new_customer;
    public $is_create_new_invoice;
    public $is_create_new_record;


    public $all_records, $all_profits, $all_costs;

    public $name, $phone,
           $edit_method_name,
           $is_view_customer_actions,
           $is_view_customer_details_actions,
           $is_view_customer_details,
           $is_view_invoice_details,
           $is_edit,
           $is_edit_details;

    // Create Mode
    protected array $create_properties_rules = [
        'create_customer_name'  => 'required',
        'create_customer_phone' => 'required|integer',
    ];

    // Create Mode
    protected array $create_properties_message = [
        'create_customer_name.required'          => 'This Field is required!',
        'create_customer_phone.required'          => 'This Field is required!',
        'create_customer_phone.integer'        => 'This Field should be integer!',
    ];

    // Edit Mode
    protected array $properties_rules = [
        'name' => ['name.*' => 'required'],
        'phone' => ['phone.*' => 'required|integer'],
    ];

    // Edit Mode
    protected array $properties_message = [
        'name' => ['name.*.required' => 'This Field is required!'],
        'phone' => [
            'phone.*.required' => 'This Field is required!',
            'phone.*.integer' => 'Phone Should be integer!',
        ],
    ];



    public function mount()
    {
        $this->is_view_customer_actions = [0 => false];
        $this->is_edit = [
            'name' => [],
            'phone' => [],
        ];
        $this->is_edit_details = [
            'description' => [],
            'brand_id' => [],
            'category_id' => [],
            'updated_at' => [],
        ];
        $this->is_create_new_customer = false;
        $this->is_create_new_invoice = false;
        $this->is_create_new_record = false;

        $is_view_customer_details = [];
        $is_view_invoice_details = [];

        $this->fields = [
            'id' => 'id',
            'name' => 'name',
            'old' => 'id',
            'new' => 'id',
        ];

        $this->breadcrumbs = [
            [
                'title' => 'Invoice Manager',
                'route' => 'backend.sales',
                'index' => 'Sales'
            ],
            [
                'route' => 'backend.invoices',
                'index' => 'Invoices'
            ],
        ];
    }

    public function render()
    {
        $all_invoicerecords = Invoicerecord::all();
        $this->all_records  = $all_invoicerecords->count();
        $this->all_costs    = $all_invoicerecords->sum('cost');
        $this->all_profits  = $all_invoicerecords->sum('profits');

        $customers = Invoicecustomer::query()->search(
            needle: $this->searchKeyword,
            orderByColumn: ($this->orderByColumn != "") ? $this->fields[$this->orderByColumn] : 'id',
            orderByDirection: ($this->orderByColumn == 'old') ? 'DESC' : 'ASC',
        );

        $customers = $customers->paginate(5);

        return view('livewire.backend.invoices.index', [
            'customers' => $customers
        ])
            ->layout('layouts.user', [
                'breadcrumbs' => $this->breadcrumbs,
            ]);
    }

    public function create_new_customer()
    {
        $this->is_create_new_customer = true;
    }

    public function not_create_new_customer()
    {
        $this->is_create_new_customer = false;
        $this->reset();
    }

    public function create_new_invoice()
    {
        $this->is_create_new_invoice = true;
    }

    public function not_create_new_invoice()
    {
        $this->is_create_new_invoice = false;
        $this->reset('create_invoice_serial');
    }

    public function create_new_record()
    {
        $this->is_create_new_record = true;
    }

    public function not_create_new_record()
    {
        $this->is_create_new_record = false;
        $this->reset('create_record_name', 'create_record_cost', 'create_record_price', 'create_record_serial');
    }

    public function store_new_customer()
    {

        try {
            // Validate data
            $this->validate($this->create_properties_rules, $this->create_properties_message);

            // Create New Customer
            Invoicecustomer::create([
                'name'          => $this->create_customer_name,
                'phone'         => $this->create_customer_phone,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        $this->reset('create_customer_name', 'create_customer_phone');
        $this->not_create_new_customer();
        session()->flash('message', "Customer has been Created Successfully.");
        session()->flash('alert', 'success');
    }

    public function store_new_record(Invoice $invoice)
    {

        try {
            // Validate data
            $this->validate([
                'create_record_name'  => 'required',
                'create_record_cost' => 'required|integer',
                'create_record_serial' => 'required|integer',
                'create_record_price' => 'required|integer',
            ], [
                'create_record_name.required'          => 'This Field is required!',
                'create_record_cost.required'          => 'This Field is required!',
                'create_record_cost.integer'        => 'This Field should be integer!',
                'create_record_serial.required'          => 'This Field is required!',
                'create_record_serial.integer'        => 'This Field should be integer!',
                'create_record_price.required'          => 'This Field is required!',
                'create_record_price.integer'        => 'This Field should be integer!',
            ]);

            // Create New Record
            Invoicerecord::create([
                'name'          => $this->create_record_name,
                'cost'          => $this->create_record_cost,
                'price'         => $this->create_record_price,
                'profit'        => $this->create_record_price - $this->create_record_cost,
                'serial'        => $this->create_record_serial,
                'invoice_id'    => $invoice->id,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            $cost = $invoice->recordsCost();
            $price = $invoice->recordsPrice();

            $invoice->update([
                'cost' => $cost,
                'price' => $price,
                'amount' => $invoice->invoicerecords->count(),
                'profit' => $price - $cost,
            ]);


        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
        }

        $this->reset('create_record_name', 'create_record_cost', 'create_record_serial', 'create_record_price');
        $this->not_create_new_record();
        session()->flash('message', "Record has been Created Successfully.");
        session()->flash('alert', 'success');
    }

    public function store_new_invoice(Invoicecustomer $invoicecustomer)
    {

        try {
            // Validate data
            $this->validate([
                'create_invoice_serial' => 'required|integer',
            ], [
                'create_invoice_invoice.required'          => 'This Field is required!',
                'create_invoice_invoice.integer'           => 'This Field should be integer!',
                ],
            );

            // Create New Customer
            Invoice::create([
                'cost'                  => 0,
                'price'                 => 0,
                'profit'                => 0,
                'amount'                => 0,
                'serial'                => $this->create_invoice_serial,
                'invoicecustomer_id'    => $invoicecustomer->id,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);

        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        $this->reset('create_invoice_serial');
        $this->not_create_new_invoice();
        session()->flash('message', "Invoice has been Created Successfully.");
        session()->flash('alert', 'success');
    }

    public function view_customer_details($id)
    {
        $this->is_view_customer_details = (isset($this->is_view_customer_details))
            ? (isset($this->is_view_customer_details[$id])
                ? (($this->is_view_customer_details[$id])
                    ? [$id => false]
                    : [$id => true])
                : [$id => true])
            : [$id => true];


    }


    public function view_invoice_details($customer_id, $invoice_id)
    {
        $this->is_view_invoice_details = (isset($this->is_view_invoice_details))
            ? (isset($this->is_view_invoice_details[$customer_id.'-'.$invoice_id])
                ? (($this->is_view_invoice_details[$customer_id.'-'.$invoice_id])
                    ? [$customer_id.'-'.$invoice_id => false]
                    : [$customer_id.'-'.$invoice_id => true])
                : [$customer_id.'-'.$invoice_id => true])
            : [$customer_id.'-'.$invoice_id => true];
    }

    public function editNew(Invoicecustomer $customer, $propertyName)
    {
        $this->is_edit = [
            'name'  => [],
            'phone' => [],
        ];
        $this->{$propertyName}[$customer->id] = $customer->{$propertyName};
        $this->is_edit[$propertyName][$customer->id] = true;
        $this->is_view_customer_actions = [];
        $this->is_view_customer_actions[$customer->id] = true;
        $this->is_edit_details[$propertyName][$customer->id] = false;
        $this->is_view_customer_details_actions[$customer->id] = false;
        $this->edit_method_name = $propertyName;
    }

    public function closeEdit($id, $propertyName)
    {
        $this->is_edit[$propertyName][$id] = false;
        $this->is_edit_details[$propertyName][$id] = false;
        $this->is_view_customer_actions[$id] = false;
        $this->is_view_customer_details_actions[$id] = false;
    }


    public function updateNew(Invoicecustomer $customer, $propertyName)
    {

        $this->validate(
            [$propertyName . '.' . $customer->id => $this->properties_rules[$propertyName][$propertyName . '.*']],
            $this->properties_message[$propertyName]
        );
        $customer->update([$propertyName => $this->{$propertyName}[$customer->id]]);
        $this->closeEdit($customer->id, $propertyName);
    }


    public function updated($propertyName)
    {
        $this->validateOnly(
            $propertyName,
            $this->create_properties_rules,
            $this->create_properties_message);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function testfuck()
    {
        dd('fuck');
    }
}
