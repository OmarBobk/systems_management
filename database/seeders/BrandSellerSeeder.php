<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class BrandSellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Default
        $default_seller = Seller::create([
            'id'       => 1,
            'name'     => 'Default',
            'phone'    => '00',
            'address'  => '-',
        ])->id;

        // El-Khatib
        $el_khatib_seller = Seller::create([
            'id'       => 2,
            'name'     => 'El-Khatib',
            'phone'    => '5376014222',
            'address'  => 'Semsitebrizi Mahallesi, Hatuniye Sk. No:9, 42030 Karatay/Konya',
        ])->id;

        // Simex
        $simex_seller = Seller::create([
            'id'       => 3,
            'name'     => 'Simex',
            'phone'    => '03323526707',
            'address'  => 'Semsitebrizi Mahallesi, Akif Pasa Sk., 42030 Karatay/Konya',
        ])->id;

        // Soffany
        $soffany_seller = Seller::create([
            'id'       => 4,
            'name'     => 'Soffany',
            'phone'    => '5327272788',
            'address'  => 'Tahtakale Mahallesi, Findikcilar Sk Pirhan, No:13, 34116 Fatih/Istanbul',
        ])->id;

        // Kensa
        $kensa_seller = Seller::create([
            'id'       => 5,
            'name'     => 'Kensa',
            'phone'    => '5323412272',
            'address'  => 'Demirtas Mh, Cemil Birsel Cd. No:13/A. Fatih Istanbul',
        ])->id;

        // Toptanci 1
        $toptanci_1_seller = Seller::create([
            'id'       => 6,
            'name'     => 'Toptanci 1',
            'phone'    => '-',
            'address'  => '-',
        ])->id;

        // Toptanci 2
        $toptanci_2_seller = Seller::create([
            'id'       => 7,
            'name'     => 'Toptanci 2',
            'phone'    => '-',
            'address'  => '-',
        ])->id;

        // Ahmad Attrah
        $ahmad_attar_seller = Seller::create([
            'id'       => 8,
            'name'     => 'Ahmad Attrah',
            'phone'    => '5524756466',
            'address'  => 'Backbag Seller',
        ])->id;

        // Concord
        $concord_seller = Seller::create([
            'id'       => 10,
            'name'     => 'Concord',
            'phone'    => '5321526442',
            'address'  => 'Semsitebrizi Mah. Osmanbey Sk. No:5/C Karatay-Konya',
        ])->id;

        // Orchid
        $orchid_seller = Seller::create([
            'id'       => 9,
            'name'     => 'Orchid',
            'phone'    => '5523138657',
            'address'  => 'Zafer',
        ])->id;

        $all_sellers = [
            $default_seller,
            $el_khatib_seller,
            $simex_seller,
            $soffany_seller,
            $kensa_seller,
            $toptanci_1_seller,
            $toptanci_2_seller,
            $ahmad_attar_seller,
            $concord_seller,
        ];

        $default_brand = Brand::create([
            'id'             => 1,
            'name'           => 'Other',
            'description'    => 'Other'
        ])->sellers()->attach($default_seller);

        $platton_brand = Brand::create([
            'id'             => 2,
            'name'           => 'Platoon',
            'description'    => 'Screens, General Accessories'
        ])->sellers()->attach([$concord_seller, $el_khatib_seller, $ahmad_attar_seller, $toptanci_1_seller, $toptanci_2_seller,$default_seller]);

        $jopus_brand = Brand::create([
            'id'             => 3,
            'name'           => 'Jopus',
            'description'    => 'Screens, General Accessories',
        ])->sellers()->attach([$el_khatib_seller, $simex_seller, $ahmad_attar_seller, $toptanci_1_seller, $toptanci_2_seller,$default_seller]);

        $syrox_brand = Brand::create([
            'id'             => 4,
            'name'           => 'Syrox',
            'description'    => 'Headphones Bluetooth Headphones, Cables, Chargers, Screens, Airpods',
        ])->sellers()->attach([$el_khatib_seller, $ahmad_attar_seller,$default_seller]);

        $mabko_brand = Brand::create([
            'id'             => 5,
            'name'           => 'Mabko',
            'description'    => 'Cables, Headphones, Bluetooth Headphones, Screens, Airpods, Chargers',
        ])->sellers()->attach([$el_khatib_seller, $ahmad_attar_seller,$default_seller]);

        $joylink_brand = Brand::create([
            'id'             => 6,
            'name'           => 'Joylink',
            'description'    => 'Cables, Chargers',
        ])->sellers()->attach([$el_khatib_seller, $ahmad_attar_seller,$default_seller]);

        $veno_brand = Brand::create([
            'id'             => 7,
            'name'           => 'Veno',
            'description'    => 'Bluetooth Headphones, iPhone\'s Headphones',
        ])->sellers()->attach([$el_khatib_seller, $ahmad_attar_seller, $toptanci_2_seller, $toptanci_1_seller,$default_seller]);

        $simex_brand = Brand::create([
            'id'             => 8,
            'name'           => 'Simex',
            'description'    => 'Screens, General Accessories',
        ])->sellers()->attach([$ahmad_attar_seller, $toptanci_2_seller, $toptanci_1_seller, $simex_seller,$default_seller]);

        $mytel_brand = Brand::create([
            'id'             => 9,
            'name'           => 'Mytell',
            'description'    => 'Screens, General Accessories',
        ])->sellers()->attach([$ahmad_attar_seller, $toptanci_2_seller, $toptanci_1_seller, $simex_seller, $el_khatib_seller,$default_seller]);

        $soffany_brand = Brand::create([
            'id'             => 10,
            'name'           => 'Soffany',
            'description'    => 'Chargers, Cables, Covers, Screens, General Accessories',
        ])->sellers()->attach([$soffany_seller ,$default_seller]);

        $tgb_brand = Brand::create([
            'id'             => 11,
            'name'           => 'TGB',
            'description'    => 'Cables, Earphones, General Accessories',
        ])->sellers()->attach([$ahmad_attar_seller, $toptanci_1_seller, $toptanci_2_seller,$default_seller]);

        $phixi_brand = Brand::create([
            'id'             => 12,
            'name'           => 'Phixi',
            'description'    => 'Cables, Chargers, General Accessories',
        ])->sellers()->attach([$ahmad_attar_seller, $toptanci_1_seller, $toptanci_2_seller,$default_seller]);

        $i12_brand = Brand::create([
            'id'             => 13,
            'name'           => 'i12',
            'description'    => 'Bluetooth Airpods',
        ])->sellers()->attach([$concord_seller, $ahmad_attar_seller, $toptanci_1_seller, $toptanci_2_seller, $el_khatib_seller,$default_seller]);

        $kensa_brand = Brand::create([
            'id'             => 14,
            'name'           => 'Kensa',
            'description'    => 'Bluetooth Airpods, Chargers, Cables, Screens, Memory Cards, Flash Memory, Speakers ..etc',
        ])->sellers()->attach([$ahmad_attar_seller, $el_khatib_seller, $kensa_seller,$default_seller]);

        $torima_brand = Brand::create([
            'id'             => 15,
            'name'           => 'Torima',
            'description'    => 'Bluetooth Headphones, Chargers, Cables ..etc',
        ])->sellers()->attach([$ahmad_attar_seller, $el_khatib_seller, $concord_seller, $toptanci_2_seller, $toptanci_1_seller,$default_seller]);

        $sprange_brand = Brand::create([
            'id'             => 16,
            'name'           => 'Sprange',
            'description'    => 'Bluetooth Airpods, Cables ..etc',
        ])->sellers()->attach([$concord_seller,$default_seller]);

        $concord_brand = Brand::create([
            'id'             => 20,
            'name'           => 'Concord',
            'description'    => 'Bluetooth Airpods, Cables, tiktok lightining, Chargers, Speakers, Flash Memories, SD Cards ..etc',
        ])->sellers()->attach([$concord_seller,$default_seller]);

        $orchid_brand = Brand::create([
            'id'             => 17,
            'name'           => 'Orchid',
            'description'    => 'Perfume, Perfume Glasses, Perfume Accessories',
        ])->sellers()->attach([$orchid_seller,$default_seller]);

        $orchid_2_brand = Brand::create([
            'id'             => 18,
            'name'           => 'Orchid',
            'description'    => 'Perfumes',
        ])->sellers()->attach([$orchid_seller,$default_seller]);

        $gifts_brand = Brand::create([
            'id'             => 19,
            'name'           => 'Toptanci Gifts',
            'description'    => 'Gift boxes, Bags ...',
        ])->sellers()->attach([$orchid_seller,$default_seller]);

    }
}
