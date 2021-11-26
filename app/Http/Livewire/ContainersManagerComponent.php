<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Models\ProductsContainer;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;

class ContainersManagerComponent extends Component
{
    public $products_counter, $total_cost;
    public $containers, $products_container;
    public $is_open_create_form;

    // create
    public $bill_id, $bills;

    public function mount()
    {
        $this->is_open_create_form = false;
    }

    public function render()
    {
        $this->products_counter = 0;
        $this->containers = ProductsContainer::all();

        return view('livewire.containers-manager.index-component')->layout('layouts.user');
    }

    #[ArrayShape(['count' => "int", 'cost' => "int"])]
    public function productsInContainer($id): array
    {
        $container = $this->containers->find($id);
        $products  = json_decode($container->container, true);
        $this->total_cost = 0;

        foreach ($products as $id => $product) {

            $this->total_cost += $product['cost'];
        }

        return ['count' => count($products), 'cost' => $this->total_cost];

    }

    public function store()
    {
        ProductsContainer::create([
            'container'  => '{}',
            'bill_id'    => $this->bill_id,
            'is_created' => 0,
        ]);

        $this->closeCreateForm();
    }

    public function openCreateForm()
    {
        $this->is_open_create_form = true;
        $this->bills = Bill::all();
    }

    public function closeCreateForm()
    {
        $this->is_open_create_form = false;
        $this->reset('bill_id');
    }

    public function viewContainer($id)
    {
        $this->redirect(route('container', $id));
    }

    public function deleteContainer($id)
    {
        ProductsContainer::destroy($id);
    }

}
