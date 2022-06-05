<?php

namespace Database\Seeders;

use App\Models\Contribution;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Exception;
use Faker\Factory;
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
        $now = \Carbon\Carbon::now();
        $products = [];

        $products[] = [
            'name'              => 'Other',
            'serial'            => 0,
            'code'              => '****',
            'amount'            => 1,
            'price'             => 0,
            'cost'              => 0,
            'slug'              => Str::slug('Other'),
            'user_id'           => 1,
            'brand_id'          => 1,
            'category_id'       => 1,
            'contribution_id'   => 1,
            'bill_id'           => 1,
            'created_at'        => $now,
            'updated_at'        => $now,
        ];

        Product::insert($products);
    }
}
