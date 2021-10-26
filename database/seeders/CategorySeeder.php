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
        $categories = [];

        $categories[] = [
            'id'            => 1,
            'name'          => 'default',
            'slug'          => Str::slug('default'),
        ];

        $categories[] = [
            'id'            => 2,
            'name'          => 'Chargers',
            'slug'          => Str::slug('Chargers'),
        ];

        $categories[] = [
            'id'            => 3,
            'name'          => 'Screens',
            'slug'          => Str::slug('Screens'),
        ];

        $categories[] = [
            'id'            => 4,
            'name'          => 'Micro Cables',
            'slug'          => Str::slug('Micro Cables'),
        ];

        $categories[] = [
            'id'            => 5,
            'name'          => 'Type-C Cables',
            'slug'          => Str::slug('Type-C Cables'),
        ];

        $categories[] = [
            'id'            => 6,
            'name'          => 'Lighting Cables',
            'slug'          => Str::slug('Lighting Cables'),
        ];

        $categories[] = [
            'id'            => 7,
            'name'          => 'Bluetooth Headphones',
            'slug'          => Str::slug('Bluetooth Headphones'),
        ];

        $categories[] = [
            'id'            => 8,
            'name'          => 'Airpods',
            'slug'          => Str::slug('Airpods'),
        ];

        $categories[] = [
            'id'            => 9,
            'name'          => 'Earphones',
            'slug'          => Str::slug('Earphones'),
        ];

        $categories[] = [
            'id'            => 10,
            'name'          => 'Bluetooth Speakers',
            'slug'          => Str::slug('Bluetooth Speakers'),
        ];

        $categories[] = [
            'id'            => 11,
            'name'          => 'Flash Drive',
            'slug'          => Str::slug('Flash Drive'),
        ];

        $categories[] = [
            'id'            => 12,
            'name'          => 'Memory Card',
            'slug'          => Str::slug('Memory Card'),
        ];

        $categories[] = [
            'id'            => 13,
            'name'          => 'Convertors',
            'slug'          => Str::slug('Convertors'),
        ];

        $categories[] = [
            'id'            => 14,
            'name'          => 'Aux Cables',
            'slug'          => Str::slug('Aux Cables'),
        ];

        $categories[] = [
            'id'            => 15,
            'name'          => 'Screens',
            'slug'          => Str::slug('Screens'),
        ];

        $categories[] = [
            'id'            => 16,
            'name'          => 'Nano Screens',
            'slug'          => Str::slug('Nano Screens'),
        ];

        $categories[] = [
            'id'            => 17,
            'name'          => 'Chargers',
            'slug'          => Str::slug('Chargers'),
        ];

        $categories[] = [
            'id'            => 18,
            'name'          => 'Charger Adapters',
            'slug'          => Str::slug('Charger Adapters'),
        ];

        $categories[] = [
            'id'            => 19,
            'name'          => 'Phones Holders',
            'slug'          => Str::slug('Phones Holders'),
        ];

        $categories[] = [
            'id'            => 20,
            'name'          => 'Headphones',
            'slug'          => Str::slug('Headphones'),
        ];

        $categories[] = [
            'id'            => 21,
            'name'          => 'Gamers Stuffs',
            'slug'          => Str::slug('Gamers Stuffs'),
        ];

        $categories[] = [
            'id'            => 22,
            'name'          => 'Power Banks',
            'slug'          => Str::slug('Power Banks'),
        ];

        $categories[] = [
            'id'            => 23,
            'name'          => 'Mouse',
            'slug'          => Str::slug('Mouse'),
        ];

        $categories[] = [
            'id'            => 24,
            'name'          => 'Youtubers Stuffs',
            'slug'          => Str::slug('Youtubers Stuffs'),
        ];

        Category::insert($categories);

    }
}
