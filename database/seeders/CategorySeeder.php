<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Factory::create();
        $categories = [];

        $categories[] = [
            'name'          => 'default',
            'slug'          => Str::slug('default'),
        ];

        for ($i=0;$i<=5;$i++) {
            $name  = $fake->name();

            $categories[] = [
                'name'          => $name,
                'slug'          => Str::slug($name),
            ];
        }

        $chunks = array_chunk($categories, 50);
        foreach ($chunks as $chunk) {
            Category::insert($chunk);
        }

        $phone_screen_protector = ['id' => 1472, 'name' => 'Screen Protector', 'slug' => Str::slug('Screen Protector')];

    }
}
