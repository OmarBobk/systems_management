<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class
ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $now = Carbon::now();
        $products = [];

        $products[] = [
            'serial'          => '8581001',
            'name'            => 'Product 1',
            'description'     => NULL,
            'code'            => 'pro-1',
            'amount'          => '10000',
            'price'           => '0',
            'cost'            => '0',
            'slug'            => 'other',
            'bill_id'         => '1',
            'brand_id'        => '1',
            'seller_id'       => '1',
            'category_id'     => '1',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ];

        $products[] = [
            'serial'          => '8581002',
            'name'            => 'Product 2',
            'description'     => NULL,
            'code'            => 'pro-2',
            'amount'          => '1000',
            'price'           => '0',
            'cost'            => '100000',
            'slug'            => 'other',
            'bill_id'         => '2',
            'brand_id'        => '1',
            'seller_id'       => '1',
            'category_id'     => '1',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ];

        $products[] = [
            'serial'          => '8581003',
            'name'            => 'Product 3',
            'description'     => NULL,
            'code'            => 'pro-3',
            'amount'          => '1000',
            'price'           => '0',
            'cost'            => '50000',
            'slug'            => 'other',
            'bill_id'         => '3',
            'brand_id'        => '8',
            'seller_id'       => '3',
            'category_id'     => '1',
            'contribution_id' => '2',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ];

        $products[] = [
            'serial'          => '8581004',
            'name'            => 'Product 4',
            'description'     => NULL,
            'code'            => 'pro-4',
            'amount'          => '1000',
            'price'           => '0',
            'cost'            => '20000',
            'slug'            => 'other',
            'bill_id'         => '4',
            'brand_id'        => '14',
            'seller_id'       => '5',
            'category_id'     => '1',
            'contribution_id' => '3',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ];

        $products[] = [
            'serial'          => '8581005',
            'name'            => 'Product 5',
            'description'     => NULL,
            'code'            => 'pro-5',
            'amount'          => '1000',
            'price'           => '0',
            'cost'            => '35000',
            'slug'            => 'other',
            'bill_id'         => '5',
            'brand_id'        => '4',
            'seller_id'       => '2',
            'category_id'     => '1',
            'contribution_id' => '4',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ];

        $chunks = array_chunk($products, 100);

        foreach ($chunks as $chunk) {
            Product::insert($chunk);
        }
    }
}
