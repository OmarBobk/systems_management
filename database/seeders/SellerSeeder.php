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

        // Default
        $sellers[] = [
            'id'       => 1,
            'name'     => 'Default',
            'phone'    => '00',
            'address'  => '-',
        ];

        // El-Khatib
        $sellers[] = [
            'id'       => 2,
            'name'     => 'El-Khatib',
            'phone'    => '5376014222',
            'address'  => 'Semsitebrizi Mahallesi, Hatuniye Sk. No:9, 42030 Karatay/Konya',
        ];

        // Simex
        $sellers[] = [
            'id'       => 3,
            'name'     => 'Simex',
            'phone'    => '03323526707',
            'address'  => 'Semsitebrizi Mahallesi, Akif Pasa Sk., 42030 Karatay/Konya',
        ];

        // Soffany
        $sellers[] = [
            'id'       => 4,
            'name'     => 'Soffany',
            'phone'    => '5327272788',
            'address'  => 'Tahtakale Mahallesi, Findikcilar Sk Pirhan, No:13, 34116 Fatih/Istanbul',
        ];

        // Kensa
        $sellers[] = [
            'id'       => 5,
            'name'     => 'Kensa',
            'phone'    => '5323412272',
            'address'  => 'Demirtas Mh, Cemil Birsel Cd. No:13/A. Fatih Istanbul',
        ];

        // Toptanci 1
        $sellers[] = [
            'id'       => 6,
            'name'     => 'Toptanci 1',
            'phone'    => '-',
            'address'  => '-',
        ];

        // Toptanci 2
        $sellers[] = [
            'id'       => 7,
            'name'     => 'Toptanci 2',
            'phone'    => '-',
            'address'  => '-',
        ];

        // Ahmad Attrah
        $sellers[] = [
            'id'       => 8,
            'name'     => 'Ahmad Attrah',
            'phone'    => '5524756466',
            'address'  => 'Backbag Seller',
        ];


        Seller::insert($sellers);
    }
}
