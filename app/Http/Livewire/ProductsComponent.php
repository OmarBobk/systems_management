<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsComponent extends Component
{
    use WithPagination;

    public bool $isCreateComponentOpen = false;
    public bool $updateMode            = false;
    public $name, $price, $cost, $serial, $product_id, $category_id, $categories;

    public function render()
    {
        return view('livewire.products.index-component', [
            'products' => Product::paginate(5),
        ])->layout('layouts.user');
    }

    public function create()
    {
        $this->resetCreateComponent();
        $this->openCreateComponent();
    }

    public function store()
    {

        $this->validate([
            'name'   => 'required',
            'serial' => 'required',
            'price'  => 'required',
            'cost'   => 'required',
        ]);

        Product::create([
            'name'        => $this->name,
            'serial'      => $this->serial,
            'price'       => $this->price,
            'cost'        => $this->cost,
            'slug'        => Str::slug($this->name),
            'user_id'     => Auth::user()->id,
            'category_id' => $this->category_id,
        ]);

        session()->flash('message', 'Product Created');
        session()->flash('alert' , 'success');

        $this->closeCreateComponent();
        $this->resetCreateComponent();

    }

    public function edit(Product $product)
    {
        $this->product_id     = $product->id;
        $this->name           = $product->name;
        $this->serial         = $product->serial;
        $this->price          = $product->price;
        $this->cost           = $product->cost;
        $this->category_id    = $product->category_id;
        $this->updateMode     = true;
        $this->openCreateComponent();
    }

    public function update()
    {

        $this->validate([
            'name'   => 'required',
            'serial' => 'required',
            'price'  => 'required',
            'cost'   => 'required',
        ]);

        Product::find($this->product_id)->update([
            'name'        => $this->name,
            'serial'      => $this->serial,
            'price'       => $this->price,
            'cost'        => $this->cost,
            'slug'        => Str::slug($this->name),
            'user_id'     => Auth::user()->id,
            'category_id' => $this->category_id,
        ]);

        session()->flash('message', 'Product Updated');
        session()->flash('alert' , 'success');

        $this->closeCreateComponent();
        $this->resetCreateComponent();
    }

    public function delete(int $id)
    {
        dd('hi');
    }

    public function openCreateComponent()
    {
        $this->isCreateComponentOpen = true;
        $this->categories = Category::all();
    }

    public function closeCreateComponent()
    {
        $this->isCreateComponentOpen = false;
    }

    public function resetCreateComponent()
    {
        $this->name         = '';
        $this->price        = '';
        $this->cost         = '';
        $this->serial       = '';
        $this->updateMode   = false;
        $this->category_id  = '';
    }


}
