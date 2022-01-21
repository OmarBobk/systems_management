<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Models\ProductsContainer;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;

class ContainersManagerComponent extends Component
{
    public $products_quantity, $total_cost;
    public $containers, $products_container;
    public $is_open_create_form;

    // create
    public $bill_id, $bills, $bills_that_does_not_have_container;

    public function mount()
    {
        $this->is_open_create_form = false;
    }

    public function render()
    {
        $this->containers = ProductsContainer::all();

        return view('livewire.containers-manager.index-component')->layout('layouts.user');
    }


    /**
     * Get The cost and the count of the products in
     * the container.
     *
     * @param $id
     * @return array
     */
    #[ArrayShape(['count' => "int", 'cost' => "int"])]
    public function productsInContainer($id): array
    {
        $container = $this->containers->find($id);
        $products  = json_decode($container->container, true);
        $this->total_cost = 0;
        $this->products_quantity = 0;

        foreach ($products as $id => $product) {

            $this->total_cost += $product['cost'] * $product['amount'];
            $this->products_quantity += $product['amount'];
        }

        return ['count' => $this->products_quantity, 'cost' => $this->total_cost];

    }

    public function store()
    {
        ProductsContainer::create([
            'container'  => '{}',
            'bill_id'    => $this->bill_id,
            'is_created' => 0,]);

        $this->closeCreateForm();
    }

    public function openCreateForm()
    {
        $bills_that_does_not_have_container_except_default_bill = array_map(
            function ($x) {return $x == 1 ? 0 : $x;},
            $this->containers->pluck('bill_id')->toArray()
        );
        $this->is_open_create_form = true;
        $this->bills = Bill::whereNotIn('id', $bills_that_does_not_have_container_except_default_bill)
            ->get();

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
