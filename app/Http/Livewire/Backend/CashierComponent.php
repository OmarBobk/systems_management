<?php

namespace App\Http\Livewire\Backend;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Contribution;
use App\Models\Debt;
use App\Models\Debtor;
use App\Models\Income;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SalesCounter;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use function redirect;
use function session;
use function view;

class CashierComponent extends Component
{
    use WithPagination;

    public  $testi;
    public $searchKeyword = '';
    public  $cart, $amount, $net_price, $description, $net_cost, $isEditAmount, $isEditPrice;
    public $is_checkout, $is_checkout_with_debt, $is_create_new_debtor_form, $is_checkout_with_debtor_exists;

    public $debtorSearchKeyword, $debtorsSearched, $is_ask_for_debts_due, $whoToAskForDebtsDueDebtorId, $due_date;
    public $newDebtorName, $newDebtorPhone;
    public $counter;

    public $amount_error_msg, $is_amount_error, $old_amount;

    public $testing;


    // New Edit Proccess
    public $edit_method_name, $is_edit,  $editable_type, $is_view_product_actions;

    // Products Amount in pivot table before updating.
    public $products_amount_in_pivot;


    public $table_data;

    protected array $rules = [
        'newDebtorName'  => 'required',
        'newDebtorPhone' => 'required',
    ];

    public $start_from = '';
    public $end_at = '';

    protected $queryString = [
        'start_from' => ['except' => ''],
        'end_at'     => ['except' => ''],
    ];

    public $menu_data =[];
//    public $pagination = 5;
//    public $selling_type = 'All';
    public $order_by = 'Date';

    public function mount()
    {

        $this->is_edit = [
            'amount'        => [],
            'net_price'     => [],
            'net_cost'      => [],
            'description'   => [],
        ];

        $this->editable_type = [
            'amount'        => 'number',
            'net_price'     => 'number',
            'net_cost'      => 'number',
            'description'   => 'textarea',
        ];

        $this->table_data = [
            'thead'             => [],
            'tbody'             => [],
            'td'                => [],
            'details_table'     => '',
            'buttons'           => '',
            'is_details_table'  => false,
            'paginate'          => false
        ];


    }

    public function render()
    {
        $breadcrumbs = [
            [
                'route' => 'backend.cashier',
                'index' => 'Cashier'
            ],
        ];

        $this->menu_data = [
//            'pagination'   => ['All', 5, 10, 15],
//            'selling_type' => ['All', 'Kontor', 'Invoice', 'Products'],
            'order_by' => ['Date', 'ID', 'Name', 'Price'],
        ];

        $ordering = [
            'Date' => 'created_at',
            'Price' => 'net_price',
            'ID' => 'id',
            'Name' => 'name',
        ];

        $this->cart = Cart::whereId(1)->first();

        $this->is_amount_error = false;

        $cart_products = CartProduct::where('cart_id', 1)
            ->whereBetween('created_at', [
                $this->start_from ==''?'1900-01-01':date('Y-m-d H:i:s', strtotime($this->start_from)),
                $this->end_at == '' ? '2322-02-11':date('Y-m-d H:i:s', strtotime($this->end_at))
            ])
            ->orderBy(
                $ordering[$this->order_by],
                'DESC'
            )
            ->get();


        $this->table_data['thead'] = [
            'No', 'Name', 'Description', 'Code', 'Amount', 'Price', 'Cost', 'Total Price', 'Total Profits', 'Date', 'Actions'
        ];
        $this->table_data['tbody'] = $cart_products;
        $this->table_data['td'] = [
            'id'            => false,
            'name'          => false,
            'description'   => true,
            'code'          => false,
            'amount'        => true,
            'net_price'     => true,
            'net_cost'      => false,
            'total_price'   => false,
            'total_profits' => false,
            'date'          => false,
            'actions'       => false,
            ];
        $this->table_data['buttons']            = 'livewire.backend.cashier.buttons';
        $this->table_data['details_table']      = '';
        $this->table_data['is_details_table']   = false;
        $this->table_data['paginate']           = false;

        return view('livewire.backend.cashier-component', [
            'result' => Product::where('amount', '>=', 1)
                ->search(
                    $this->searchKeyword,
                    'id',
                )->paginate(5),
        ])
            ->layout('layouts.user', [
                'breadcrumbs' => $breadcrumbs,

            ]);
    }

    /**
     * Search For a product by barcode
     */
    public function updatedSearchKeyword()
    {

        $this->resetPage();

    }

    /**
     * $id is Product id
     * @param Product $product
     */
    public function addItemToCart(Product $product)
    {
        $product->decrement('amount', 1);

        $this->cart->products()->attach($product->id, ['amount' => 1,
            'code'        => $product->code,
            'name'        => $product->name,
            'net_price'   => $product->price,
            'net_cost'    => $product->cost,
            'description' => 'Description',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
            ]);

//        if($product->amount < 1 ) $this->result->forget($product->id);
    }

    /**
     * Is the item is exists in the cart??
     *
     * @param Product $product
     * @return bool
     */
    public function isItemExists(Product $product): bool
    {
        return $product->carts()->count() > 0;
    }

    /**
     * Update The Cart: if request to add
     * an exists item don't add it again
     * but update the amount by adding 1.
     *
     * @param Product $product
     */
    public function updateTheCart(Product $product)
    {
        $cart = $this->cart;
        $products = $cart->products();
        $product = $products->find($product->id);

        $products->updateExistingPivot($product->id, ['amount' => $product->pivot->amount + 1]);
    }

    public function removeItemFromCart(CartProduct $cartProduct)
    {
        $product_id = $cartProduct->product_id;
        $pivot_id   = $cartProduct->id;
        $products = $this->cart->products();
        $product  = $products->whereProductId($product_id)->wherePivot('id', $pivot_id);

        $product->first()->increment('amount', $product->first()->pivot->amount);
        $product->detach($product_id);


    }

    public function emptyTheCart()
    {
        $cart   = $this->cart;

        foreach ($cart->products as $product) {
            $product->increment('amount', $product->pivot->amount);
        }

        $cart->products()->detach();
    }




    public function checkout()
    {
        if ($this->cart->products()->count() < 1) {
            session()->flash('message', 'Your Cart Is Empty');
            session()->flash('alert', 'danger');
            return;
        }
        $this->is_checkout           = true;
        $this->is_checkout_with_debt = false;
    }

    public function createSales()
    {
        $sales         = [];
        $incomes       = [];

        // Generating An id for the sales.
        $latest_sale = Sale::latest('id');

        $sale_id_start_at = ($latest_sale->count() >= 1) ? $latest_sale->first()->id : 1;

        $x = 1;

        foreach($this->cart->products as $product) {

            $sale_id         = $sale_id_start_at + $x;
            $amount          = $product->pivot->amount;
            $description     = $product->pivot->description;
            $net_price       = $product->pivot->net_price;
            $cost            = $product->pivot->net_cost;
            $total_price     = $net_price * $amount;
            $profit          = ($net_price - $cost) * $amount;
            $user_id         = Auth::user()->id;
            $product_id      = $product->id;
            $contribution_id = $product->contribution_id;

            $sales[] = [
                'id'                => $sale_id,
                'description'       => $description,
                'net_price'         => $net_price,
                'cost'              => $cost,
                'amount'            => $amount,
                'total'             => $total_price,
                'profit'            => $profit,
                'user_id'           => $user_id,
                'saleable_id'       => $product_id,
                'saleable_type'     => 'App\Models\Product',
                'contribution_id'   => $contribution_id,
                'created_at'        => $product->pivot->created_at,
                'updated_at'        => $product->pivot->updated_at,
            ];

            // Decrement Products amount.
            $product->decrement('amount', $amount);

            // Create Sales Counter Records
            $product_counter = SalesCounter::where('product_id', $product->id);

            ($product_counter->count() > 0)
                ? $product_counter->increment('counter', $amount)
                : SalesCounter::create(['product_id' => $product->id, 'counter' => $amount]);

            $contribution = Contribution::find($contribution_id);

            // Return Product Cost to its contribution.
            $cost_amount = $cost * $amount;
//            $contribution->increment('amount', $cost_amount);

            $incomes[] = [
                'amount'          => $cost_amount,
                'type'            => 'cost',
                'sale_id'         => $sale_id,
                'user_id'         => Auth::user()->id,
                'contribution_id' => $contribution_id,
                'created_at'      => $product->pivot->created_at,
                'updated_at'      => $product->pivot->updated_at,
            ];


            // Add the sale profits to its contribution.
            $contribution_profit_percent = $contribution->profits_percent;
            $contribution_profit = ($profit * $contribution_profit_percent) / 100;
            $incomes[] = [
                'amount'          => $contribution_profit,
                'type'            => 'profit',
                'sale_id'         => $sale_id,
                'user_id'         => Auth::user()->id,
                'contribution_id' => $contribution_id,
                'created_at'      => $product->pivot->created_at,
                'updated_at'      => $product->pivot->updated_at,
            ];

            // If the profit percent != 100 then the contributor
            // is not the owner so ...
            if ($contribution_profit_percent < 100) {
                // Add The rest of the profits to the owner.
                $incomes[] = [
                    'amount'          => $profit - $contribution_profit,
                    'type'            => 'profit',
                    'sale_id'         => $sale_id,
                    'user_id'         => Auth::user()->id,
                    'contribution_id' => 1,
                    'created_at'      => $product->pivot->created_at,
                    'updated_at'      => $product->pivot->updated_at,
                ];
            }


            $x += 1;

        }

        $chunks = array_chunk($sales, 50);

        foreach ($chunks as $chunk) Sale::insert($chunk);

        $chunks = array_chunk($incomes, 50);

        foreach ($chunks as $chunk) Income::insert($chunk);


        // Create New Bill and save the details inside it

        $this->emptyTheCart();

        session()->flash('sales_message', 'Sales Created Successfully');
        session()->flash('sales_alert', 'success');

    }

    /**
     * Checkout the cart With Cash.
     * @return Application|RedirectResponse|Redirector
     */
    public function checkoutCash()
    {

        $this->createSales();

        return redirect(route('backend.cashier'));

    }


    /**
     * Checkout the cart as debts.
     */
    public function checkoutDebt()
    {
        $this->is_checkout_with_debt = true;
    }

    public function checkoutDebtorExists()
    {
        $this->is_checkout_with_debtor_exists = true;
        $this->is_create_new_debtor_form = false;
    }

    /**
     * if debtor doesn't exists.
     */
    public function createNewDebtorForm()
    {
        $this->resetCreateNewDebtorForm();
        $this->is_create_new_debtor_form = true;
    }

    /**
     * create new debtor.
     */
    public function store()
    {
        $now = Carbon::now();

        $this->validate();

        $debtor = Debtor::create([
            'name'        => $this->newDebtorName,
            'phone'       => $this->newDebtorPhone,
            'user_id'     => Auth::user()->id,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);

        session()->flash('message', 'Debtor Created');
        session()->flash('alert' , 'success');

        $this->closeCreateDebtorComponent();
        $this->resetCreateNewDebtorForm();

        $this->createDebtsFromCart($debtor);

    }

    public function closeCreateDebtorComponent()
    {
        $this->is_create_new_debtor_form = false;
    }

    public function updatedDebtorSearchKeyword()
    {
        $this->debtorsSearched = Debtor::orWhere('name', 'like', "%$this->debtorSearchKeyword%")
            ->orWhere('phone', 'like', "%$this->debtorSearchKeyword%")->get();
    }

    public function whoToAskForDebtsDue(Debtor $debtor)
    {
        $id = $debtor->id;

        $this->whoToAskForDebtsDueDebtorId = $id;
        $this->is_ask_for_debts_due = true;

        $this->emit('askForDueEvent', $id);
    }

    /**
     * Checkout: Create Debts and Sales for
     * the given debtor and until the given due from the
     * given items in the cart.
     *
     * @param Debtor $debtor
     */
    public function createDebtsFromCart(Debtor $debtor)
    {
        $debts = [];

        $now = Carbon::now();

        $products = $this->cart->products;

        foreach($products as $product) {
            $debts[] = [
                'item_name'     => $product->name,
                'description'   => $product->pivot->description,
                'cost'          => $product->pivot->net_cost,
                'price'         => $product->pivot->net_price,
                'amount'        => $product->pivot->amount,
                'is_paid'       => 0,
                'due'           => $this->due_date ?? Carbon::now()->addMonth()->toDateString(),
                'product_id'    => $product->id,
                'debtor_id'     => $debtor->id,
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }


        $chunks = array_chunk($debts, 50);

        foreach ($chunks as $chunk) Debt::insert($chunk);

        $this->createSales();

        session()->flash('debts_message', 'Debts Created Successfully');
        session()->flash('debts_alert', 'success');

        redirect(route('cashier'));

    }

    public function resetCreateNewDebtorForm()
    {
        $this->reset('newDebtorName', 'newDebtorPhone');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function edit_field(CartProduct $product, $propertyName)
    {

        $this->testi = $product->id;
        $this->products_amount_in_pivot = $product->amount;

        $this->is_edit = [
            'amount'   => [],
            'net_price'   => [],
            'net_cost'   => [],
            'description'   => [],
        ];

        $this->{$propertyName}[$product->id]          = $product->{$propertyName};
        $this->is_edit[$propertyName][$product->id]   = true;
        $this->is_view_product_actions                = [];
        $this->is_view_product_actions[$product->id]  = true;
        $this->edit_method_name                       = $propertyName;
    }
    public function updateNew($product_id, $propertyName)
    {

        $this->testi = $this->{$propertyName}[$product_id];
        // Product with pivot table.
        $products = $this->cart->products();

        // Updating the amount in the cart_product table (pivot)
        // Not the amount in the products table.
        CartProduct::find($product_id)->update([$propertyName => $this->{$propertyName}[$product_id]]);
//        $products->updateExistingPivot($product_id, [$propertyName => $this->{$propertyName}[$product_id]]);

        $this->closeEdit($product_id, $propertyName);
    }
    public function closeEdit($product_id, $propertyName)
    {
        $this->is_edit[$propertyName][$product_id]  = false;
        $this->is_view_product_actions[$product_id] = false;

        if ( $propertyName === 'amount') $this->updateProductsAmountInTheStock($product_id);
    }

    public function updateProductsAmountInTheStock($id)
    {
        $cartProduct = CartProduct::find($id);
        // Product need to be updated.
        $product_in_stock = Product::find($cartProduct->product_id);

        // Product in pivot table.
        $product_in_pivot = $cartProduct;

        // Old Amount In the Pivot.
        $old_pivot_amount = $this->products_amount_in_pivot;

        // New Amount In the Pivot.
        $new_pivot_amount = $product_in_pivot->amount;

        if ($old_pivot_amount != null) {
            if($new_pivot_amount > $old_pivot_amount) {
                $edited_amount = $new_pivot_amount - $old_pivot_amount;

                // decrement amount in products table.
                $product_in_stock->decrement('amount', $edited_amount);

            } elseif($new_pivot_amount < $old_pivot_amount) {
                $edited_amount = $old_pivot_amount - $new_pivot_amount;
                // increment amount in products table
                $product_in_stock->increment('amount', $edited_amount);

            }
        }

    }

    public function updatingAmount($value, $index)
    {
//        dd($value, $index);
//        $product_id = explode('-', $index)[0];
//        $pivot_id   = explode('-', $index)[1];

        $this->products_amount_in_pivot = CartProduct::find($index)->amount;
    }

}
