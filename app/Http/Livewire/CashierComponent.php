<?php

namespace App\Http\Livewire;

use App\Models\Cart;
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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CashierComponent extends Component
{

    public $searchKeyword, $result, $cart, $amount, $net_price, $description, $net_cost, $isEditAmount, $isEditPrice;
    public $is_checkout, $is_checkout_with_debt, $is_create_new_debtor_form, $is_checkout_with_debtor_exists;

    public $debtorSearchKeyword, $debtorsSearched, $is_ask_for_debts_due, $whoToAskForDebtsDueDebtorId, $due_date;
    public $newDebtorName, $newDebtorPhone;
    public $counter;

    public $amount_error_msg, $is_amount_error, $old_amount;

    public $testing;


    // New Edit Proccess
    public $edit_method_name, $is_edit, $is_view_product_actions;

    // Products Amount in pivot table before updating.
    public $products_amount_in_pivot;

    protected array $rules = [
        'newDebtorName'  => 'required',
        'newDebtorPhone' => 'required',
    ];

    public function mount()
    {

        $this->is_edit = [
            'amount'   => [],
            'net_price'   => [],
            'net_cost'   => [],
            'description'   => [],
        ];

    }

    public function render()
    {

        $breadcrumbs = [
            [
                'route' => 'cashier',
                'index' => 'Cashier'
            ],
        ];

        $this->cart = Cart::with('products')->whereId(1)->first();
        $this->is_amount_error = false;

        return view('livewire.cashier-component')
            ->layout('layouts.user', [
                'breadcrumbs' => $breadcrumbs,
            ]);
    }

    /**
     * Search For a product by barcode
     */
    public function updatedSearchKeyword()
    {
        $this->result = Product::where('amount', '>=', 1)
            ->search(
                needle: $this->searchKeyword,
                orderByColumn: 'id',
            )
            ->get();
    }

    /**
     * $id is Product id
     * @param Product $product
     */
    public function addItemToCart(Product $product)
    {
        $product->decrement('amount', 1);

        $this->cart->products()->attach($product->id, ['amount' => 1,
            'net_price'   => $product->price,
            'net_cost'    => $product->cost,
            'description' => 'Description',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
            ]);

        if($product->amount < 1 ) $this->result = [];
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

    public function removeItemFromCart($product_id, $pivot_id)
    {
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
                'product_id'        => $product_id,
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

        return redirect(route('cashier'));

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


    public function editNew($product_id, $pivot_id, $propertyName)
    {
        $this->products_amount_in_pivot = $this->cart->products()->whereProductId($product_id)->wherePivot('id', $pivot_id)->first()->pivot->amount;

        // Product with pivot table.
        $product = $this->cart->products()->whereProductId($product_id)->wherePivot('id', $pivot_id)->first();

        $this->is_edit = [
            'amount'   => [],
            'net_price'   => [],
            'net_cost'   => [],
            'description'   => [],
        ];

        $this->{$propertyName}[$product_id."-".$pivot_id]          = $product->pivot->{$propertyName};
        $this->is_edit[$propertyName][$product_id."-".$pivot_id]   = true;
        $this->is_view_product_actions                = [];
        $this->is_view_product_actions[$product_id."-".$pivot_id]  = true;
        $this->edit_method_name                       = $propertyName;
    }
    public function updateNew($product_id, $pivot_id, $propertyName)
    {

        // Product with pivot table.
        $products = $this->cart->products();
        $product = $products->whereProductId($product_id)->wherePivot('id', $pivot_id)->first();

        // Updating the amount in the cart_product table (pivot)
        // Not the amount in the products table.
        $products->updateExistingPivot($product_id, [$propertyName => $this->{$propertyName}[$product_id.'-'.$pivot_id]]);

        $this->closeEdit($product_id, $pivot_id, $propertyName);
    }
    public function closeEdit($product_id, $pivot_id, $propertyName)
    {
        $this->is_edit[$propertyName][$product_id.'-'.$pivot_id]  = false;
        $this->is_view_product_actions[$product_id.'-'.$pivot_id] = false;

        if ( $propertyName === 'amount') $this->updateProductsAmountInTheStock($product_id, $pivot_id);
    }

    public function updateProductsAmountInTheStock($product_id, $pivot_id)
    {
        // Product need to be updated.
        $product_in_stock = Product::find($product_id);

        // Product in pivot table.
        $product_in_pivot = $this->cart->products()->whereProductId($product_id)->wherePivot('id', $pivot_id)->first();

        // Old Amount In the Pivot.
        $old_pivot_amount = $this->products_amount_in_pivot;

        // New Amount In the Pivot.
        $new_pivot_amount = $product_in_pivot->pivot->amount;

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
        $product_id = explode('-', $index)[0];
        $pivot_id   = explode('-', $index)[1];

        $this->products_amount_in_pivot = $this->cart->products()->whereProductId($product_id)->wherePivot('id', $pivot_id)->first()->pivot->amount;
    }

}
