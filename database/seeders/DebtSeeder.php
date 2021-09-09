<?php

namespace Database\Seeders;

use App\Models\Debt;
use App\Models\Debtor;
use App\Models\Product;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DebtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake     = Factory::create();
        $debts    = [];
        $products = collect(Product::all());
        $debtors  = collect(Debtor::all()->modelKeys());

        for ($i=0;$i<=50;$i++) {
            $product = $products->random();
            $debts[] = [
                'item_name'     => $product->name,
                'description'   => '',
                'amount'        => 1,
                'cost'          => $product->cost,
                'price'         => $product->price,
                'is_paid'       => 0,
                'due'           => Carbon::tomorrow(),
                'product_id'    => $product->id,
                'debtor_id'     => $debtors->random(),
            ];
        }

        $chunks = array_chunk($debts, 50);
        foreach ($chunks as $chunk) {
            Debt::insert($chunk);
        }
    }
}
