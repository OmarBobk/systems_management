<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CashierComponent extends Component
{

    public $searchKeyword, $result, $cart;

    public function render()
    {
        $this->cart = Cart::find(1);
        return view('livewire.cashier-component')->layout('layouts.user');
    }

    /**
     * $id is Product id
     * @param $id
     */
    public function addItemToCart($id)
    {
        $cart = Cart::find(1);
        $cart->products()->attach($id);
    }

    public function removeItemFromCart($id)
    {
        $cart = Cart::find(1);
        $cart->products()->detach($id);
    }

    public function updatedSearchKeyword()
    {
        $this->result = Product::where("serial", "like", "$this->searchKeyword%")->orderBy('id')->get();
    }

    public function emptyTheCart()
    {
        $this->cart->products()->detach();
    }

}
