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
            'seller_id'      => 1,
        ];

        // El-Khatib Brands
        $brands[] = [
            'id'             => 11,
            'name'           => 'Platoon',
            'description'    => 'Screens, General Accessories',
            'seller_id'      => 2,
        ];

        $brands[] = [
            'id'             => 21,
            'name'           => 'Jopus',
            'description'    => 'Screens, General Accessories',
            'seller_id'      => 2,
        ];

        $brands[] = [
            'id'             => 2,
            'name'           => 'Syrox',
            'description'    => 'Headphones Bluetooth Headphones, Cables, Chargers, Screens, Airpods',
            'seller_id'      => 2,
        ];

        $brands[] = [
            'id'             => 3,
            'name'           => 'Mabko',
            'description'    => 'Cables, Headphones, Bluetooth Headphones, Screens, Airpods, Chargers',
            'seller_id'      => 2,
        ];

        $brands[] = [
            'id'             => 4,
            'name'           => 'Joinlink',
            'description'    => 'Cables, Chargers',
            'seller_id'      => 2,
        ];

        $brands[] = [
            'id'             => 5,
            'name'           => 'Veno',
            'description'    => 'Bluetooth Headphones, iPhone\'s Headphones',
            'seller_id'      => 2,
        ];

        $brands[] = [
            'id'             => 6,
            'name'           => 'Other',
            'description'    => 'Other',
            'seller_id'      => 1,
        ];

        // Simex
        $brands[] = [
            'id'             => 7,
            'name'           => 'Jopus',
            'description'    => 'Screens, General Accessories',
            'seller_id'      => 3,
        ];

        $brands[] = [
            'id'             => 8,
            'name'           => 'Simex',
            'description'    => 'Screens, General Accessories',
            'seller_id'      => 3,
        ];

        $brands[] = [
            'id'             => 9,
            'name'           => 'Mytell',
            'description'    => 'Screens, General Accessories',
            'seller_id'      => 3,
        ];

        $brands[] = [
            'id'             => 12,
            'name'           => 'Other',
            'description'    => 'Other',
            'seller_id'      => 3,
        ];

        // Soffany
        $brands[] = [
            'id'             => 10,
            'name'           => 'Soffany',
            'description'    => 'Chargers, Cables, Covers, Screens, General Accessories',
            'seller_id'      => 4,
        ];

        $brands[] = [
            'id'             => 13,
            'name'           => 'Other',
            'description'    => 'Other',
            'seller_id'      => 3,
        ];


        Brand::insert($brands);
    }
}
