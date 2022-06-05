<?php

namespace Database\Seeders;
use App\Models\Brand;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [];

        $brands[] = [
            'id'             => 1,
            'name'           => 'Default',
            'description'    => 'Default',

        ];

        // El-Khatib Brands
        $brands[] = [
            'id'             => 11,
            'name'           => 'Platoon',
            'description'    => 'Screens, General Accessories',

        ];

        $brands[] = [
            'id'             => 21,
            'name'           => 'Jopus',
            'description'    => 'Screens, General Accessories',

        ];

        $brands[] = [
            'id'             => 2,
            'name'           => 'Syrox',
            'description'    => 'Headphones Bluetooth Headphones, Cables, Chargers, Screens, Airpods',

        ];

        $brands[] = [
            'id'             => 3,
            'name'           => 'Mabko',
            'description'    => 'Cables, Headphones, Bluetooth Headphones, Screens, Airpods, Chargers',

        ];

        $brands[] = [
            'id'             => 4,
            'name'           => 'Joinlink',
            'description'    => 'Cables, Chargers',

        ];

        $brands[] = [
            'id'             => 5,
            'name'           => 'Veno',
            'description'    => 'Bluetooth Headphones, iPhone\'s Headphones',

        ];

        $brands[] = [
            'id'             => 6,
            'name'           => 'Other',
            'description'    => 'Other',

        ];

        // Simex
        $brands[] = [
            'id'             => 7,
            'name'           => 'Jopus',
            'description'    => 'Screens, General Accessories',

        ];

        $brands[] = [
            'id'             => 8,
            'name'           => 'Simex',
            'description'    => 'Screens, General Accessories',

        ];

        $brands[] = [
            'id'             => 9,
            'name'           => 'Mytell',
            'description'    => 'Screens, General Accessories',

        ];

        $brands[] = [
            'id'             => 12,
            'name'           => 'Other',
            'description'    => 'Other',

        ];

        // Soffany
        $brands[] = [
            'id'             => 10,
            'name'           => 'Soffany',
            'description'    => 'Chargers, Cables, Covers, Screens, General Accessories',

        ];

        $brands[] = [
            'id'             => 13,
            'name'           => 'Other',
            'description'    => 'Other',

        ];


        Brand::insert($brands);
    }
}
