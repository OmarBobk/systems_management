<?php

namespace Database\Seeders;

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
        $fake = Factory::create();
        $products = [];
        $category_ids = collect(Category::all()->modelKeys());

        for ($i=0;$i<=10;$i++) {
            $name  = $fake->name();
            $price = random_int(10, 200);
            $cost  = intval(floor(($price * 20) / 100));
            $products[] = [
                'serial'        => random_int(1324567891234, 9876543214321),
                'name'          => $name,
                'code'          => $name,
                'amount'        => 2,
                'price'         => $price,
                'cost'          => $cost,
                'slug'          => Str::slug($name),
                'user_id'       => 1,
                'category_id'   => $category_ids->random(),
            ];
        }

        $chunks = array_chunk($products, 50);
        foreach ($chunks as $chunk) {
            Product::insert($chunk);
        }
    }
}
