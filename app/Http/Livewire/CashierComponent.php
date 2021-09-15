<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Debt;
use App\Models\Debtor;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CashierComponent extends Component
{

    public $searchKeyword, $result, $cart, $amount, $net_price, $isEditAmount, $isEditPrice;
    public $is_checkout, $is_checkout_with_debt, $is_create_new_debtor_form, $is_checkout_with_debtor_exists;

    public $debtorSearchKeyword, $debtorsSearched, $is_ask_for_debts_due, $whoToAskForDebtsDueDebtorId, $due_date;
    public $newDebtorName, $newDebtorPhone;
    public $counter;
    protected array $rules = [
        'newDebtorName'  => 'required',
        'newDebtorPhone' => 'required',
    ];

    public function increment()

    {

        $this->count++;

    }

    public function mount()
    {
        $this->counter = 0;
    }

    public function render()
    {
        $this->cart = Cart::find(1);
        return view('livewire.cashier-component')->layout('layouts.user');
    }

    /**
     * $id is Product id
     * @param Product $product
     */
    public function addItemToCart(Product $product)
    {
        if ($this->isItemExists($product)) {
            $this->updateTheCart($product);
        } else {
            $this->cart->products()->attach($product->id, ['amount' => 1, 'net_price' => $product->price]);
        }
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
        $this->cart->products()->detach($id);
    }

    public function emptyTheCart()
    {
        $this->cart->products()->detach();
    }

    public function editAmount(Product $product)
    {
        $this->isEditAmount = [$product->id => true];
        $this->isEditPrice  = [$product->id => false];
        $this->amount[$product->id] = $product->carts()->first()->pivot->amount;
    }

    public function updateAmountAttach($id)
    {
        $this->isEditAmount = [$id => false];
        if (isset($this->amount[$id])) {
            $this->cart->products()->updateExistingPivot($id, ['amount' => $this->amount[$id]]);
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

    public function updatedSearchKeyword()
    {
        $this->result = Product::where("serial", "like", "$this->searchKeyword%")->orderBy('id')->get();
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
        $products     = $this->cart->products;
        $sales        = [];

        foreach($products as $product) {
            $amount    = $product->carts()->first()->pivot->amount;
            $net_price = $product->carts()->first()->pivot->net_price;
            $sales[] = [
                'net_price'    => $product->price,
                'cost'         => $product->cost,
                'amount'       => $amount,
                'total'        => $product->price * $amount,
                'profit'       => $product->price - $product->cost,
                'user_id'      => Auth::user()->id,
                'product_id'   => $product->id,
            ];
        }

        $chunks = array_chunk($sales, 50);

        foreach ($chunks as $chunk) Sale::insert($chunk);

        // Create New Bill and save the details inside of it

        $this->emptyTheCart();

        session()->flash('sales_message', 'Sales Created Successfully');
        session()->flash('sales_alert', 'success');

    }

    public function checkoutCash()
    {

        $this->createSales();

        return redirect(route('cashier'));

    }


    public function checkoutDebt()
    {
        $this->is_checkout_with_debt = true;
    }

    public function checkoutDebtorExists()
    {
        $this->is_checkout_with_debtor_exists = true;
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
     * Create Debts for the given debtor
     * and until the given due from the
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



    public function resetCreateNewDebtorForm()
    {
        $this->reset('newDebtorName', 'newDebtorPhone');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function testingAction()
    {
        dd($this->askDue);
    }

}
