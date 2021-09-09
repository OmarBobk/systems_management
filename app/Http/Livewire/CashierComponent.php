<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CashierComponent extends Component
{

    public $searchKeyword, $result, $cart, $amount, $net_price, $isEditAmount, $isEditPrice;

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

    public function checkoutCash()
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

        return redirect(route('cashier'));

    }

    public function testingAction()
    {
        dd('hi there');
    }

}
