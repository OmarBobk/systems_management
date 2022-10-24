<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Productsection;
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

        $name = 'Other';
        $description = [
            '1' => "Other Products",
            '2' => "Products without costs",
            '3' => "units, bills, repareing",
        ];
        $id = 1;
        $code = 'other';
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => $code,
            'serial'          => '0000000000',
            'description'     => $description,
            'amount'          => '10000',
            'price'           => '0',
            'cost'            => '0',
            'bill_id'         => '1',
            'brand_id'        => '1',
            'seller_id'       => '1',
            'category_id'     => '101',
            'contribution_id' => '1',
            'user_id'         => '1',
            'extra_attributes' => [
                'color' => [
                    ['name' => 'Red', 'value' => 'red', 'order' => 0, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_0.jpg', 'is_active' => 1,],
                    ['name' => 'Blue', 'value' => 'blue', 'order' => 1, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_1.jpg', 'is_active' => 1,],
                    ['name' => 'White', 'value' => 'white', 'order' => 2, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_2.jpg', 'is_active' => 1,],
                ],
            ],
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);



        $on_sale = Productsection::create([
            'title' => 'On Sale',
            'order' => 0,
        ]);
        $on_sale->products()->attach(1);

        $latest = Productsection::create([
            'title' => 'Latest Products',
            'order' => 1,
        ]);
        $latest->products()->attach(1);

        $discounted = Productsection::create([
            'title' => 'Discounted products',
            'order' => 2,
        ]);
        $discounted->products()->attach(1);

    }
}
