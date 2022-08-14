<?php

namespace Database\Seeders;

use App\Http\Livewire\ProductsContainerComponent;
use Illuminate\Database\Seeder;

class ProductsContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $container = [
            'container'       => "{}",
            'bill_id'         => 2,
            'contribution_id' => 1,
        ];


        ProductsContainerComponent::create($container);
    }
}
