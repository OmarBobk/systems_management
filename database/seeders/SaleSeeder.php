<?php

namespace Database\Seeders;

use App\Models\Contribution;
use App\Models\Product;
use App\Models\Sale;
use Exception;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $sales = [];
        $product_ids = collect(Product::all()->modelKeys());
        $contributions_ids = collect(Contribution::all()->modelKeys());

        for ($i=0;$i<200;$i++) {
            $price = random_int(10, 200);
            $cost  = intval(floor(($price * 20) / 100));
            $sales[] = [
                'net_price'          => $price,
                'cost'               => $cost,
                'amount'             => $price,
                'total'              => $cost,
                'profit'             => $cost,
                'user_id'            => 1,
                'product_id'         => $product_ids->random(),
                'contribution_id'    => $contributions_ids->random(),
            ];
        }

        $chunks = array_chunk($sales, 50);
        foreach ($chunks as $chunk) {
            Sale::insert($chunk);
        }

    }
}
