<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Contributor;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsComponent extends Component
{
    use WithPagination;

    public bool $isCreateComponentOpen = false;
    public bool $updateMode            = false;
    public $name, $price, $cost, $serial, $product_id, $category_id, $categories,
        $seller_id, $sellers, $amount, $code, $contribution_id, $contributions,
        $contributors, $contributor_id;

    public $brands; // used for storing the requested brands.
    public $brand_id; // used for create.

    protected array $rules = [
        'name'          => 'required',
        'serial'        => 'required',
        'price'         => 'required',
        'cost'          => 'required',
        'category_id'   => 'integer',
        'seller_id'     => 'integer',
    ];

    protected array $messages = [
        'category_id.integer' => 'You must select a Category'
    ];

    public function render()
    {
        $this->counter = 0;
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

        $this->validate();

        Product::create([
            'name'            => $this->name,
            'serial'          => $this->serial,
            'code'            => $this->code,
            'price'           => $this->price,
            'cost'            => $this->cost,
            'amount'          => $this->amount,
            'slug'            => Str::slug($this->name),
            'user_id'         => Auth::user()->id,
            'category_id'     => $this->category_id,
            'contribution_id' => $this->contribution_id,
            'brand_id'        => $this->brand_id,
        ]);

        session()->flash('message', 'Product Created');
        session()->flash('alert' , 'success');

        $this->closeCreateComponent();
        $this->resetCreateComponent();

    }

    public function edit(Product $product)
    {
        $this->product_id       = $product->id;
        $this->name             = $product->name;
        $this->serial           = $product->serial;
        $this->code             = $product->code;
        $this->price            = $product->price;
        $this->cost             = $product->cost;
        $this->category_id      = $product->category_id;
        $this->updateMode       = true;
        $this->openCreateComponent();
    }

    public function update()
    {

        $this->validate([
            'name'   => 'required',
            'amount' => 'required|min:1',
            'serial' => 'required',
            'code'   => 'required',
            'price'  => 'required',
            'cost'   => 'required',
            'category_id'   => 'integer',
            'seller_id'   => 'integer',
        ]);

        Product::find($this->product_id)->update([
            'name'            => $this->name,
            'serial'          => $this->serial,
            'code'            => $this->code,
            'price'           => $this->price,
            'cost'            => $this->cost,
            'amount'          => $this->amount,
            'slug'            => Str::slug($this->name),
            'user_id'         => Auth::user()->id,
            'category_id'     => $this->category_id,
            'contribution_id' => $this->contribution_id,
            'brand_id'        => $this->brand_id,
        ]);

        session()->flash('message', 'Product Updated');
        session()->flash('alert' , 'success');

        $this->closeCreateComponent();
        $this->resetCreateComponent();
    }

    public function delete(int $id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product deleted.');
        session()->flash('alert', 'success');
    }

    public function openCreateComponent()
    {
        $this->isCreateComponentOpen = true;
        $this->categories            = Category::all();
        $this->sellers               = Seller::all();
        $this->contributors          = Contributor::all();
    }

    public function closeCreateComponent()
    {
        $this->isCreateComponentOpen = false;
    }

    public function resetCreateComponent()
    {
        $this->reset('name', 'price', 'cost', 'serial', 'updateMode',
            'category_id', 'seller_id', 'amount', 'code', 'contribution_id', 'contributor_id', 'brand_id',);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSellerId()
    {
        $seller = Seller::find($this->seller_id);
        $this->brands = ($seller) ? $seller->brands : [];
    }

    public function updatedContributorId()
    {
        $contributor         = Contributor::with(['contributions' => function ($query) {
            $query->whereStatus(0);
        }])->whereId($this->contributor_id)->first();
        $this->contributions = ($contributor) ? $contributor->contributions : [];
    }


}
