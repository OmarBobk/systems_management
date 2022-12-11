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
        $description = [
            '1' => "This product will be sent by Talebetti",
            '2' => "Compatible with all smart devices.",
            '3' => "Warranty Period 24 months.",
            '4' => "Bluetooth / Flash Memory / Memory Card",
            '5' => "Ultra Bass Balance",
            '6' => "Working Distance: ~10 meters",
            '7' => "Options for use with aux audio cable, USB memory and memory card",
            '8' => "Volume and music control keys",
            '9' => "Ultra-powerful and impressive wireless audio experience",
            '10' => "Eye-catching adjustable colorful LED lights",
        ];
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
            'brand_id'        => '11',
            'seller_id'       => '1',
            'category_id'     => '26',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);

        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);


        $name = 'Kensa KM-375 Bluetooth Speaker';
        $description = [
            '1' => 'This product will be sent by Talebetti',
            '2' => 'Compatible with all smart devices.',
            '3' => 'Warranty Period 24 months.',
            '4' => 'Bluetooth / Flash Memory / Memory Card',
            '5' => 'Ultra Bass Balance',
            '6' => 'Working Distance: ~10 meters',
            '7' => 'Options for use with aux audio cable, USB memory and memory card',
            '8' => 'Volume and music control keys',
            '9' => 'Ultra-powerful and impressive wireless audio experience',
        ];
        $id = 2;
        $code = 'km-375';
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KM-375',
            'serial'          => '8681749638307',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '49999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '26',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now,
            'extra_attributes' => [
                'color' => [
                    ['name' => 'Red', 'value' => 'red', 'order' => 0, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_0.jpg', 'is_active' => 1,],
                    ['name' => 'Blue', 'value' => 'blue', 'order' => 1, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_1.jpg', 'is_active' => 1,],
                    ['name' => 'White', 'value' => 'white', 'order' => 2, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_2.jpg', 'is_active' => 1,],
                ],
            ],
        ]);
        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);

        $name = 'Kensa KM-290 Bluetooth Speaker';
        $description = [
            '1' => 'This product will be sent by Talebetti',
            '2' => 'Compatible with all smart devices.',
            '3' => 'Warranty Period 24 months.',
            '4' => 'Bluetooth / Flash Memory / Memory Card',
            '5' => 'Ultra Bass Balance',
            '6' => 'Working Distance: ~10 meters',
            '7' => 'Options for use with aux audio cable, USB memory and memory card',
            '8' => 'Volume and music control keys',
            '9' => 'Ultra-powerful and impressive wireless audio experience',
        ];
        $id = 3;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KM-290',
            'serial'          => '8681749637430',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '29999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '26',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);
        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);

        $name = 'Kensa KM-258 Bluetooth Speaker';
        $description = [
            '1' => 'This product will be sent by Talebetti"',
            '2' => 'Compatible with all smart devices."',
            '3' => 'Warranty Period 24 months."',
            '4' => 'Bluetooth / Flash Memory / Memory Card"',
            '5' => 'Ultra Bass Balance"',
            '6' => 'Working Distance: ~10 meters"',
            '7' => 'Options for use with aux audio cable, USB memory and memory card"',
            '8' => 'Volume and music control keys"',
            '9' => 'Ultra-powerful and impressive wireless audio experience"',
            '10' => 'Eye-catching adjustable colorful LED lights',
        ];
        $id = 4;
        $code = 'km-258';
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KM-258',
            'serial'          => '8681749633753',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '59999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '26',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now,
            'extra_attributes' => [
                'color' => [
                    ['name' => 'Red', 'value' => 'red', 'order' => 0, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_0.jpg', 'is_active' => 1,],
                    ['name' => 'Blue', 'value' => 'blue', 'order' => 1, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_1.jpg', 'is_active' => 1,],
                ],
            ],
        ]);
        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);
        $order = 1;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);

        $name = 'Kensa KO-120 Gaming Headset';
        $description = [
            '1' => 'This product will be sent by Talebetti',
            '2' => 'On-Ear Headphones with Microphone',
            '3' => 'Warranty Period 24 months.',
            '4' => 'Call & Talk & Listen to Music',
            '5' => '3.5MM Jack Input',
            '6' => 'Ultra Bass Balance',
            '7' => 'Compatible with all Jack input devices.',
            '8' => 'Easily portable with its foldable design',
            '9' => 'Enjoy your games with Extra Bass',
            '10' => 'Eye-catching colorful LED lights',
        ];
        $id = 5;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KO-120',
            'serial'          => '8681749634477',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '44999',
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
        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);

        $name = 'Kensa KO-130 Gaming Headset';
        $description = [
            '1' => 'This product will be sent by Talebetti',
            '2' => 'On-Ear Headphones with Microphone',
            '3' => 'Warranty Period 24 months.',
            '4' => 'Call & Talk & Listen to Music',
            '5' => '3.5MM Jack Input',
            '6' => 'Ultra Bass Balance',
            '7' => 'Compatible with all Jack input devices.',
            '8' => 'Easily portable with its foldable design',
            '9' => 'Enjoy your games with Extra Bass',
        ];
        $id = 6;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'KO-130',
            'serial'          => '8681749635665',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '34999',
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
        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);

        $name = 'Kensa A-27 Aux Audio Cable';
        $description = [
            '1' => 'This product will be sent by Talebetti',
            '2' => '1.2m, 3.5mm Jack Cable',
            '3' => 'Warranty Period 24 months.',
            '4' => 'Music Audio Cable',
            '5' => '3.5MM Jack Input',
            '6' => 'Speaking with Microphone',
            '7' => 'Compatible with all Jack input devices.',
        ];
        $id = 7;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'A-27',
            'serial'          => '8681749635665',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '31999',
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
        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);

        $name = 'JOPUS Ritmo - Headphones JS-80';
        $description = [
            '1' => 'This product will be sent by Talebetti',
            '2' => 'Wired headset',
            '3' => 'Extendable Headset',
            '4' => '3.5MM Jack Input',
            '5' => 'Speaking with Microphone',
            '6' => 'Compatible with all Jack input devices.',
        ];
        $id = 8;
        $code = 'js-80';
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => $code,
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
            'updated_at'      => $now,
            'extra_attributes' => [
                'color' => [
                    ['name' => 'Red', 'value' => 'red', 'order' => 0, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_0.jpg', 'is_active' => 1,],
                    ['name' => 'Blue', 'value' => 'blue', 'order' => 1, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_1.jpg', 'is_active' => 1,],
                    ['name' => 'White', 'value' => 'white', 'order' => 2, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_2.jpg', 'is_active' => 1,],
                    ['name' => 'Black', 'value' => 'black', 'order' => 3, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_3.jpg', 'is_active' => 1,],
                    ['name' => 'Green', 'value' => 'green', 'order' => 4, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_4.jpg', 'is_active' => 1,],
                    ['name' => 'Pink', 'value' => 'pink', 'order' => 5, 'image' => asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_5.jpg', 'is_active' => 1,],
                ],
            ],
        ]);
        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);
        $order = 1;
        $image_path = asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);
        $order = 2;
        $image_path = asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);
        $order = 3;
        $image_path = asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);
        $order = 4;
        $image_path = asset('assets/images/products').'/'.strtolower($code).'/'.strtolower($code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);



        $name = 'Kensa O-22 Metal Body Type-C OTG';
        $description = [
            '1' => 'This product will be sent by Talebetti',
            '2' => 'Connection Type is Type-C',
        ];
        $id = 9;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'o-22',
            'serial'          => '8681749635665',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '39999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '12',
            'seller_id'       => '1',
            'category_id'     => '25',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);
        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);


        $name = 'KTS-1175 Bluetooth Speaker';
        $description = [
            '1' => 'This product will be sent by Talebetti',
            '2' => '8 inch bluetooth speaker.',
            '3' => 'Remote control and microphone',
            '4' => 'Wireless Transmission Range: up to 10 meters.',
            '5' => 'Output: 10W + 10W',
            '6' => 'Eye-catching colorful LED lights',
        ];
        $id = 10;
        $product = Product::create([
            'id'              => $id,
            'name'            => $name,
            'slug'            => Str::slug($name),
            'code'            => 'kts-1175',
            'serial'          => '8681749635665',
            'description'     => $description,
            'amount'          => '1',
            'price'           => '39999',
            'cost'            => '222',
            'bill_id'         => '1',
            'brand_id'        => '14',
            'seller_id'       => '1',
            'category_id'     => '100',
            'contribution_id' => '1',
            'user_id'         => '1',
            'created_at'      => $now,
            'updated_at'      => $now
        ]);
        $order = 0;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);
        $order = 1;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);
        $order = 2;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
        ]);
        $order = 3;
        $image_path = asset('assets/images/products').'/'.strtolower($product->code).'/'.strtolower($product->code).'_'.$order.'.jpg';
        $product->images()->create([
            'path' => $image_path,
            'name' => $product->slug,
            'type' => 'jpg',
            'order' => $order,
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
