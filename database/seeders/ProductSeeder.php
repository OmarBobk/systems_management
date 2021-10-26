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
        $products = [];

        $products[] = [
            'name'              => 'Wireless Stereo Earphones',
            'serial'            => 8690000020775,
            'code'              => 'KH-HB21',
            'amount'            => 3,
            'price'             => 90,
            'cost'              => 60,
            'slug'              => Str::slug('Wireless Stereo Earphones'),
            'user_id'           => 1,
            'brand_id'          => 5,
            'category_id'       => 8,
            'contribution_id'   => 1,
        ];

        $products[] = [
            'name'              => 'Bass Earphones',
            'serial'            => 4414436520173,
            'code'              => 'PL-3050',
            'amount'            => 5,
            'price'             => 15,
            'cost'              => 5,
            'slug'              => Str::slug('Bass Earphones'),
            'user_id'           => 1,
            'brand_id'          => 11,
            'category_id'       => 9,
            'contribution_id'   => 1,
        ];

        $products[] = [
            'name'              => 'Stereo Earphone',
            'serial'            => 4414136520176,
            'code'              => 'PL-3060',
            'amount'            => 5,
            'price'             => 15,
            'cost'              => 5,
            'slug'              => Str::slug('Stereo Earphone'),
            'user_id'           => 1,
            'brand_id'          => 11,
            'category_id'       => 9,
            'contribution_id'   => 1,
        ];

        $products[] = [
            'name'              => 'Other',
            'serial'            => 0,
            'code'              => '****',
            'amount'            => 1,
            'price'             => 0,
            'cost'              => 0,
            'slug'              => Str::slug('Other'),
            'user_id'           => 1,
            'brand_id'          => 6,
            'category_id'       => 1,
            'contribution_id'   => 1,
        ];

        Product::insert($products);
    }
}
