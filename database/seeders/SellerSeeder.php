<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sellers = [];

        // El-Khatib
        $sellers[] = [
            'id'       => 1,
            'name'     => 'El-Khatib',
            'phone'    => '5376014222',
            'address'  => 'Semsitebrizi Mahallesi, Hatuniye Sk. No:9, 42030 Karatay/Konya',
        ];

        // Simex
        $sellers[] = [
            'id'       => 2,
            'name'     => 'Simex',
            'phone'    => '03323526707',
            'address'  => 'Semsitebrizi Mahallesi, Akif Pasa Sk., 42030 Karatay/Konya',
        ];

        // Soffany
        $sellers[] = [
            'id'       => 3,
            'name'     => 'Soffany',
            'phone'    => '5327272788',
            'address'  => 'Tahtakale Mahallesi, Findikcilar Sk Pirhan, No:13, 34116 Fatih/Istanbul',
        ];


        Seller::insert($sellers);
    }
}
