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

        $name       = 'Electronic';
        $electronic = Category::create([
                'id' => 1,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => null,
            ]
        );
        $electronic->image()->create([
            'path' => asset('assets/images/categories').'/'.$electronic->slug.'.jpg',
            'name' => $electronic->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Small Home Appliances';
        $small_home_appliances = Category::create([
                'id' => 5,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 1,
            ]
        );
        $small_home_appliances->image()->create([
            'path' => asset('assets/images/categories').'/'.$small_home_appliances->slug.'.jpg',
            'name' => $small_home_appliances->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);




        $name       = 'Phones';
        $phones = Category::create([
                'id' => 6,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 1,
            ]
        );
        $phones->image()->create([
            'path' => asset('assets/images/categories').'/'.$phones->slug.'.jpg',
            'name' => $phones->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);



        $name       = 'Computer & Tablet';
        $computer_tablet = Category::create([
                'id' => 7,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 1,
            ]
        );
        $computer_tablet->image()->create([
            'path' => asset('assets/images/categories').'/'.$computer_tablet->slug.'.jpg',
            'name' => $computer_tablet->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name       = 'TV & Soundbar';
        $tv_soundbar = Category::create([
                'id' => 8,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 1,
            ]
        );
        $tv_soundbar->image()->create([
            'path' => asset('assets/images/categories').'/'.$tv_soundbar->slug.'.jpg',
            'name' => $tv_soundbar->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);



        $name = 'Men';
        $men  = Category::create([
                'id' => 2,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => null,
            ]
        );
        $men->image()->create([
            'path' => asset('assets/images/categories').'/'.$men->slug.'.jpg',
            'name' => $men->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Clothes';
        $clothes  = Category::create([
                'id' => 9,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 2,
            ]
        );
        $clothes->image()->create([
            'path' => asset('assets/images/categories').'/'.$clothes->slug.'.jpg',
            'name' => $clothes->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name     = 'Shoe';
        $shoe  = Category::create([
                'id' => 10,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 2,
            ]
        );
        $shoe->image()->create([
            'path' => asset('assets/images/categories').'/'.$shoe->slug.'.jpg',
            'name' => $shoe->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Personal care';
        $personal_care  = Category::create([
                'id' => 11,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 2,
            ]
        );
        $personal_care->image()->create([
            'path' => asset('assets/images/categories').'/'.$personal_care->slug.'.jpg',
            'name' => $personal_care->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name     = 'Underwear';
        $underwear  = Category::create([
                'id' => 12,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 2,
            ]
        );
        $underwear->image()->create([
            'path' => asset('assets/images/categories').'/'.$underwear->slug.'.jpg',
            'name' => $underwear->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name  = 'Women';
        $women = Category::create([
                'id' => 3,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => null,
            ]
        );
        $women->image()->create([
            'path' => asset('assets/images/categories').'/'.$women->slug.'.jpg',
            'name' => $women->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name     = 'Clothes';
        $clothes  = Category::create([
                'id' => 13,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 3,
            ]
        );
        $clothes->image()->create([
            'path' => asset('assets/images/categories').'/'.$clothes->slug.'.jpg',
            'name' => $clothes->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Shoe';
        $shoe  = Category::create([
                'id' => 14,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 2,
            ]
        );
        $shoe->image()->create([
            'path' => asset('assets/images/categories').'/'.$shoe->slug.'.jpg',
            'name' => $shoe->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name     = 'Underwear';
        $underwear  = Category::create([
                'id' => 15,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 2,
            ]
        );
        $underwear->image()->create([
            'path' => asset('assets/images/categories').'/'.$underwear->slug.'.jpg',
            'name' => $underwear->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name     = 'Cosmetic';
        $underwear  = Category::create([
                'id' => 16,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => 2,
            ]
        );
        $underwear->image()->create([
            'path' => asset('assets/images/categories').'/'.$underwear->slug.'.jpg',
            'name' => $underwear->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name       = 'Childrens';
        $childrens  = Category::create([
                'id' => 4,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1,
                'category_id' => null,
            ]
        );
        $childrens->image()->create([
            'path' => asset('assets/images/categories').'/'.$childrens->slug.'.jpg',
            'name' => $childrens->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);




        $name       = 'Ironing Machine';
        $cat        = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 5,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Coffee Machine';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 5,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name       = 'Phone Cover & Case';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 6,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Phone Charger';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 6,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Phone Powerbank';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 6,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Earphone';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 6,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Car Accessories';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 6,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Memory Card and Flash Memory';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 6,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Other Items';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 6,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name       = 'Tablet';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 7,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Monitor';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 7,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Computer Components';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 7,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Network & Modems';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 7,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name       = 'TV';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 8,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Speaker';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 8,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name     = 'T-short';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 9,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Short';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 9,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Shirt';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 9,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Tracksuit';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 9,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Pants';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 9,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Jacket';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 9,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Waistcoat';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 9,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Jumper';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 9,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'SweatShirt';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 9,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);


        $name     = 'Sport Shoe';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 10,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Clasic';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 10,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Winter Shoes';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 10,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Perfume';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 11,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Boxer';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 12,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Sock';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 12,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Pyjamas';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 12,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'T-short';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 13,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Dress';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 13,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Shirt';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 13,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Pants';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 13,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Coats';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 13,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Blouse';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 13,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Sport Shoe';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 14,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Snow Boot';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 14,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Clasic';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 14,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Heeled shoes';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 14,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Sandals';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 14,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Slipper';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 14,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Sneaker';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 14,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Nighty';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 15,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Sock';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 15,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Pyjamas';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 15,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Bra';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 15,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Fancy Clothing';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 15,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Perfume';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Eye make-up';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Skin care';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Hair care';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Make-up';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Sexual Health';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Body Care';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Shower Gels & Creams';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Lipstick';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name     = 'Suntan cream';
        $cat = Category::create(['name' => $name,'slug' => Str::slug($name),'status' => 1,'category_id' => 16,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);

        $name       = 'Mop';
        $cat = Category::create(['name' => $name, 'slug' => Str::slug($name), 'status' => 1, 'category_id' => 5,]);
        $cat->image()->create([
            'path' => asset('assets/images/categories').'/'.$cat->slug.'.jpg',
            'name' => $cat->slug,
            'type' => 'jpg',
            'order' => 0,
        ]);
    }
}
