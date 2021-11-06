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

    public $searchKeyword, $result, $cart, $amount, $net_price, $isEditAmount, $isEditPrice;
    public $is_checkout, $is_checkout_with_debt, $is_create_new_debtor_form, $is_checkout_with_debtor_exists;

    public $debtorSearchKeyword, $debtorsSearched, $is_ask_for_debts_due, $whoToAskForDebtsDueDebtorId, $due_date;
    public $newDebtorName, $newDebtorPhone;
    public $counter;

    public $amount_error_msg, $is_amount_error, $old_amount;

    protected array $rules = [
        'newDebtorName'  => 'required',
        'newDebtorPhone' => 'required',
    ];

    public function increment()

    {

        $this->count++;

    }

    /**
     * @param $value
     * @param $index // is the product id
     * @throws ValidationException
     */
    public function updatedAmount($value, $index)
    {
        $max_amount = $this->cart->products()->find($index)->amount + $this->old_amount[$index];

        $this->validateOnly("amount.$index", ['amount.*' => "integer|min:1|max:$max_amount"], [
            'amount.*.min' => "Amount Must be at least 1.",
            'amount.*.max' => "Amount Must not be more than $max_amount.",
        ]);
    }

    public function updated($propertyName)
    {

    }

    public function mount()
    {

    }

    public function render()
    {
        $this->cart = Cart::find(1);
        $this->is_amount_error = false;
        return view('livewire.cashier-component')->layout('layouts.user');
    }

    /**
     * Search For a product by barcode
     */
    public function updatedSearchKeyword()
    {
        $this->result = Product::where('amount', '>=', 1)
            ->where("serial", "like", "%$this->searchKeyword%")->orderBy('id')->get();
    }

    /**
     * $id is Product id
     * @param Product $product
     */
    public function addItemToCart(Product $product)
    {
        $product->decrement('amount', 1);

        if ($this->isItemExists($product)) {
            $this->updateTheCart($product);
        } else {
            $this->cart->products()->attach($product->id, ['amount' => 1, 'net_price' => $product->price]);
        }
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

    public function removeItemFromCart($id)
    {
        $products = $this->cart->products();
        $product  = $products->find($id);
        $product ->increment('amount', $product->pivot->amount);
        $products->detach($id);
    }

    public function emptyTheCart()
    {
        $cart   = $this->cart;
        $amount = $cart->products()->first()->pivot->amount;

        foreach ($cart->products as $product)
            $product->increment('amount', $amount);

        $cart->products()->detach();
    }


    /**
     * Edit Fields
     *  Amount & Price
     */
    public function editAmount(Product $product)
    {
        $this->old_amount[$product->id] = $product->carts()->first()->pivot->amount;
        $this->isEditAmount = [$product->id => true];
        $this->isEditPrice  = [$product->id => false];
        $this->amount[$product->id] = $product->carts()->first()->pivot->amount;
    }

    public function updateAmountAttach($id)
    {

        $product = $this->cart->products()->find($id);

        // Product Amount.
        $max_amount = $product->amount + $this->amount[$id] + $this->old_amount[$id];

        $this->validate(["amount.$id" => "integer|min:1|max:$max_amount"], [
            'amount.*.min' => "Amount Must be at least 1.",
            'amount.*.max' => "Amount Must not be more than $max_amount.",
        ]);

        $this->isEditAmount = [$id => false];
        if (isset($this->amount[$id])) {
            $this->cart->products()->updateExistingPivot($id, ['amount' => $this->amount[$id]]);
            $product->decrement('amount', abs($this->amount[$id] - $this->old_amount[$id]));
        }
    }

    public function closeUpdateAmountAttach($id)
    {
        $this->isEditAmount = [$id => false];
    }


    public function editPrice(Product $product)
    {
        $this->isEditAmount            = [$product->id => false];
        $this->isEditPrice             = [$product->id => true];
        $this->net_price[$product->id] = $product->carts()->first()->pivot->net_price;
    }

    public function updatePriceAttach($id)
    {
        $this->isEditPrice = [$id => false];
        if (isset($this->net_price[$id])) {
            $this->cart->products()->updateExistingPivot($id, ['net_price' => $this->net_price[$id]]);
        }
    }

    public function closeUpdatePriceAttach($id)
    {
        $this->isEditPrice = [$id => false];
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
        $products      = $this->cart->products;
        $sales         = [];
        $incomes       = [];

        // Generating An id for the sales.
        $latest_sale = Sale::latest('id');

        $sale_id_start_at = ($latest_sale->count() >= 1) ? $latest_sale->first()->id : 1;

        $x = 1;

        foreach($products as $product) {
            $sale_id         = $sale_id_start_at + $x;
            $amount          = $product->carts()->first()->pivot->amount;
            $net_price       = $product->carts()->first()->pivot->net_price;
            $cost            = $product->cost;
            $total_price     = $net_price * $amount;
            $profit          = ($net_price - $cost) * $amount;
            $user_id         = Auth::user()->id;
            $product_id      = $product->id;
            $contribution_id = $product->contribution_id;


            $sales[] = [
                'id'                => $sale_id,
                'net_price'         => $net_price,
                'cost'              => $cost,
                'amount'            => $amount,
                'total'             => $total_price,
                'profit'            => $profit,
                'user_id'           => $user_id,
                'product_id'        => $product_id,
                'contribution_id'   => $contribution_id,
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
            $incomes[] = [
                'amount'          => $cost_amount,
                'type'            => 'cost',
                'sale_id'         => $sale_id,
                'user_id'         => Auth::user()->id,
                'contribution_id' => $contribution_id,
            ];
            $contribution->increment('amount', $cost_amount);

            // Add the sale profits to its contribution.
            $contribution_profit_percent = $contribution->profits_percent;
            $contribution_profit = ($profit * $contribution_profit_percent) / 100;
            $incomes[] = [
                'amount'          => $contribution_profit,
                'type'            => 'profit',
                'sale_id'         => $sale_id,
                'user_id'         => Auth::user()->id,
                'contribution_id' => $contribution_id,
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

        $this->validate();

        $debtor = Debtor::create([
            'name'        => $this->newDebtorName,
            'phone'       => $this->newDebtorPhone,
            'user_id'     => Auth::user()->id,
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

        $products = $this->cart->products;

        foreach($products as $product) {
            $debts[] = [
                'item_name'     => $product->name,
                'description'   => '',
                'cost'          => $product->cost,
                'price'         => $product->pivot->net_price,
                'amount'        => $product->pivot->amount,
                'is_paid'       => 0,
                'due'           => $this->due_date ?? Carbon::now()->addMonth()->toDateString(),
                'product_id'    => $product->id,
                'debtor_id'     => $debtor->id,
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

}
