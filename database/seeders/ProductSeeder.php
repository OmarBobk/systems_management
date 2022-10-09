<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Productsection;
use Carbon\Carbon;
use Exception;
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
        $now = Carbon::now();
        $profit = 80;


        $name = 'Kensa KM-364 Bluetooth Speaker';
        $description = '{"1": "This product will be sent by Talebetti","2": "Compatible with all smart devices.","3": "Warranty Period 24 months.""4": "Bluetooth / Flash Memory / Memory Card","5": "Ultra Bass Balance","6": "Working Distance: ~10 meters","7": "Options for use with aux audio cable, USB memory and memory card","8": "Volume and music control keys","9": "Ultra-powerful and impressive wireless audio experience","10": "Eye-catching adjustable colorful LED lights",}';
        $id = 1;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KM-364',
            'serial'          => '8681749637980',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '39999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '8',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $price = 12 + ((12 * $profit)/100);
        $attributes = $product->attributes()->create([
            'name' => 'price',
            'value' => $price,
            'type' => 'price',
            'additional' => '{"currency": "usd"}',
            'order' => 0,

        ]);

        $product->images()->create([
            'path' => asset('assets/images/products').'/'.$product->serial.'.jpg',
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name = 'Kensa KM-375 Bluetooth Speaker';
        $description = '{"1": "This product will be sent by Talebetti","2": "Compatible with all smart devices.","3": "Warranty Period 24 months.""4": "Bluetooth / Flash Memory / Memory Card","5": "Ultra Bass Balance","6": "Working Distance: ~10 meters","7": "Options for use with aux audio cable, USB memory and memory card","8": "Volume and music control keys","9": "Ultra-powerful and impressive wireless audio experience",}';
        $id = 2;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KM-375',
            'serial'          => '8681749638307',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '39999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '8',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $price = 11 + ((11 * $profit)/100);
        $attributes = $product->attributes()->create([
            'name' => 'price',
            'value' => $price,
            'type' => 'price',
            'additional' => '{"currency": "usd"}',
            'order' => 0,

        ]);

        $product->images()->create([
            'path' => asset('assets/images/products').'/'.$product->serial.'.jpg',
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name = 'Kensa KM-290 Bluetooth Speaker';
        $description = '{"1": "This product will be sent by Talebetti","2": "Compatible with all smart devices.","3": "Warranty Period 24 months.""4": "Bluetooth / Flash Memory / Memory Card","5": "Ultra Bass Balance","6": "Working Distance: ~10 meters","7": "Options for use with aux audio cable, USB memory and memory card","8": "Volume and music control keys","9": "Ultra-powerful and impressive wireless audio experience",}';
        $id = 3;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KM-290',
            'serial'          => '8681749637430',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '39999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '8',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $price = 11 + ((11 * $profit)/100);
        $attributes = $product->attributes()->create([
            'name' => 'price',
            'value' => $price,
            'type' => 'price',
            'additional' => '{"currency": "usd"}',
            'order' => 0,

        ]);

        $product->images()->create([
            'path' => asset('assets/images/products').'/'.$product->serial.'.jpg',
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name = 'Kensa KM-258 Bluetooth Speaker';
        $description = '{"1": "This product will be sent by Talebetti","2": "Compatible with all smart devices.","3": "Warranty Period 24 months.""4": "Bluetooth / Flash Memory / Memory Card","5": "Ultra Bass Balance","6": "Working Distance: ~10 meters","7": "Options for use with aux audio cable, USB memory and memory card","8": "Volume and music control keys","9": "Ultra-powerful and impressive wireless audio experience","10": "Eye-catching adjustable colorful LED lights",}';
        $id = 4;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KM-258',
            'serial'          => '8681749633753',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '39999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '8',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $price = 11 + ((11 * $profit)/100);
        $attributes = $product->attributes()->create([
            'name' => 'price',
            'value' => $price,
            'type' => 'price',
            'additional' => '{"currency": "usd"}',
            'order' => 0,

        ]);

        $product->images()->create([
            'path' => asset('assets/images/products').'/'.$product->serial.'.jpg',
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name = 'Kensa KO-120 Gaming Headset';
        $description = '{"1": "This product will be sent by Talebetti","2": "On-Ear Headphones with Microphone","3": "Warranty Period 24 months.""4": "Call & Talk & Listen to Music","5": "3.5MM Jack Input","6": "Ultra Bass Balance","7": "Compatible with all Jack input devices.","8": "Easily portable with its foldable design","9": "Enjoy your games with Extra Bass","10": "Eye-catching colorful LED lights",}';
        $id = 5;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KO-120',
            'serial'          => '8681749633753',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '39999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '25',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $price = 11 + ((11 * $profit)/100);
        $attributes = $product->attributes()->create([
            'name' => 'price',
            'value' => $price,
            'type' => 'price',
            'additional' => '{"currency": "usd"}',
            'order' => 0,

        ]);

        $product->images()->create([
            'path' => asset('assets/images/products').'/'.$product->serial.'.jpg',
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name = 'Kensa KO-130 Gaming Headset';
        $description = '{"1": "This product will be sent by Talebetti","2": "On-Ear Headphones with Microphone","3": "Warranty Period 24 months.""4": "Call & Talk & Listen to Music","5": "3.5MM Jack Input","6": "Ultra Bass Balance","7": "Compatible with all Jack input devices.","8": "Easily portable with its foldable design","9": "Enjoy your games with Extra Bass",}';
        $id = 6;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KO-130',
            'serial'          => '8681749635665',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '39999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '25',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $price = 11 + ((11 * $profit)/100);
        $attributes = $product->attributes()->create([
            'name' => 'price',
            'value' => $price,
            'type' => 'price',
            'additional' => '{"currency": "usd"}',
            'order' => 0,

        ]);

        $product->images()->create([
            'path' => asset('assets/images/products').'/'.$product->serial.'.jpg',
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $on_sale = Productsection::create([
            'title' => 'On Sale',
            'order' => 0,
        ]);
        $on_sale->products()->attach([1, 2, 3, 4, 5, 6]);

        $latest = Productsection::create([
            'title' => 'Latest Products',
            'order' => 1,
        ]);
        $latest->products()->attach([1, 2, 3, 4, 5, 6]);

        $discounted = Productsection::create([
            'title' => 'Discounted products',
            'order' => 2,
        ]);
        $discounted->products()->attach([1, 2, 3, 4, 5, 6]);

    }
}
