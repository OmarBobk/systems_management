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

        $name = 'Product 1';
        $description = '{"1": "Possibility of returning the product within one day.", "2": "This product will be sent by Talebetti", "3": "another Description line about the product"}';
        $id = 1;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'pro-1',
            'serial'          => '8581001',
            'description'     => $description,
            'amount'          => '10',
            'price'           => '100',
            'cost'            => '50',
            'bill_id'         => '1',
            'brand_id'        => '1',
            'seller_id'       => '1',
            'category_id'     => '29',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $attributes = $product->attributes()->create([
            'name' => 'Price',
            'value' => '7',
            'type' => 'price',
            'additional' => '{"currency": "usd"}',
            'order' => 0,

        ]);

        $name = 'Product 2';
        $description = '{"1": "Possibility of returning the product within one day.", "2": "This product will be sent by Talebetti", "3": "another Description line about the product"}';
        $id = 2;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'pro-2',
            'serial'          => '85810201',
            'description'     => $description,
            'amount'          => '10',
            'price'           => '100',
            'cost'            => '50',
            'bill_id'         => '1',
            'brand_id'        => '1',
            'seller_id'       => '1',
            'category_id'     => '98',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $attributes = $product->attributes()->create([
            'name' => 'Price',
            'value' => '7',
            'type' => 'price',
            'additional' => '{"currency": "usd"}',
            'order' => 0,

        ]);

        $name = 'Product 3';
        $description = '{"1": "Possibility of returning the product within one day.", "2": "This product will be sent by Talebetti", "3": "another Description line about the product"}';
        $id = 3;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'pro-3',
            'serial'          => '85830201',
            'description'     => $description,
            'amount'          => '10',
            'price'           => '100',
            'cost'            => '50',
            'bill_id'         => '1',
            'brand_id'        => '1',
            'seller_id'       => '1',
            'category_id'     => '98',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $attributes = $product->attributes()->create([
            'name' => 'Price',
            'value' => '7',
            'type' => 'price',
            'additional' => '{"currency": "usd"}',
            'order' => 0,

        ]);

    }
}
