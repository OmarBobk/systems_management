<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $markalar = [
            'title' => 'Markalar',
            'image' => 'markalar',
            'order' => 0,
            'status' => 1,
        ];

        $markalar = Slider::create($markalar);
        $markalar_image = [
            'path' => asset('assets/images/slider').'/'.$markalar->image.'.jpg',
            'name' => $markalar->image,
            'type' => 'jpg',
            'order' => 0,
        ];

        $markalar->background()->create($markalar_image);

        $kensa = [
            'title' => 'Kensa Products',
            'sub_title' => '20% net discount in cart',
            'url' => '#',
            'image' => 'kensa',
            'sm_image' => 'sm_kensa',
            'order' => 0,
        ];
        $kensa = $markalar->slidercontents()->create($kensa);

        $kensa_image = [
            'path' => asset('assets/images/slidercontent').'/'.$kensa->image.'.jpg',
            'name' => $kensa->image,
            'type' => 'jpg',
            'order' => 0,
        ];
        $kensa_sm_image = [
            'path' => asset('assets/images/slidercontent').'/'.$kensa->sm_image.'.jpg',
            'name' => $kensa->sm_image,
            'type' => 'jpg',
            'order' => 0,
        ];

        $kensa->big_image()->create($kensa_image);
        $kensa->small_image()->create($kensa_sm_image);

        $syrox = [
            'title' => 'Syrox Products',
            'sub_title' => '20% net discount in cart',
            'url' => '#',
            'image' => 'syrox',
            'sm_image' => 'sm_syrox',
            'order' => 1,
        ];
        $syrox = $markalar->slidercontents()->create($syrox);

        $syrox_image = [
            'path' => asset('assets/images/slidercontent').'/'.$syrox->image.'.jpg',
            'name' => $syrox->image,
            'type' => 'jpg',
            'order' => 0,
        ];
        $syrox_sm_image = [
            'path' => asset('assets/images/slidercontent').'/'.$syrox->sm_image.'.jpg',
            'name' => $syrox->sm_image,
            'type' => 'jpg',
            'order' => 0,
        ];

        $syrox->big_image()->create($syrox_image);
        $syrox->small_image()->create($syrox_sm_image);

        $simex = [
            'title' => 'Simex Products',
            'sub_title' => '20% net discount in cart',
            'url' => '#',
            'image' => 'simex',
            'sm_image' => 'sm_simex',
            'order' => 2,
        ];
        $simex = $markalar->slidercontents()->create($simex);

        $simex_image = [
            'path' => asset('assets/images/slidercontent').'/'.$simex->image.'.jpg',
            'name' => $simex->image,
            'type' => 'jpg',
            'order' => 0,
        ];
        $simex_sm_image = [
            'path' => asset('assets/images/slidercontent').'/'.$simex->sm_image.'.jpg',
            'name' => $simex->sm_image,
            'type' => 'jpg',
            'order' => 0,
        ];

        $simex->big_image()->create($simex_image);
        $simex->small_image()->create($simex_sm_image);

        $concord = [
            'title' => 'Concord Products',
            'sub_title' => '20% net discount in cart',
            'url' => '#',
            'image' => 'concord',
            'sm_image' => 'sm_concord',
            'order' => 3,
        ];
        $concord = $markalar->slidercontents()->create($concord);

        $concord_image = [
            'path' => asset('assets/images/slidercontent').'/'.$concord->image.'.jpg',
            'name' => $concord->image,
            'type' => 'jpg',
            'order' => 0,
        ];
        $concord_sm_image = [
            'path' => asset('assets/images/slidercontent').'/'.$concord->sm_image.'.jpg',
            'name' => $concord->sm_image,
            'type' => 'jpg',
            'order' => 0,
        ];

        $concord->big_image()->create($concord_image);
        $concord->small_image()->create($concord_sm_image);


        $bugune_ozel = [
            'title' => 'Bugüne Özel',
            'image' => 'bugune_ozel',
            'order' => 1,
            'status' => 1,
        ];

        $bugune_ozel = Slider::create($bugune_ozel);
        $bugune_ozel_image = [
            'path' => asset('assets/images/slider').'/'.$bugune_ozel->image.'.jpg',
            'name' => $bugune_ozel->image,
            'type' => 'jpg',
            'order' => 0,
        ];

        $bugune_ozel->background()->create($bugune_ozel_image);

        $kampanya_1 = [
            'title' => 'Practical Kitchen Products',
            'sub_title' => 'Affordable prices',
            'url' => '#',
            'image' => 'kampanya_1',
            'sm_image' => 'sm_kampanya_1',
            'order' => 0,
        ];
        $kampanya_1 = $markalar->slidercontents()->create($kampanya_1);

        $kampanya_1_image = [
            'path' => asset('assets/images/slidercontent').'/'.$kampanya_1->image.'.jpg',
            'name' => $kampanya_1->image,
            'type' => 'jpg',
            'order' => 0,
        ];
        $kampanya_1_sm_image = [
            'path' => asset('assets/images/slidercontent').'/'.$kampanya_1->sm_image.'.jpg',
            'name' => $kampanya_1->sm_image,
            'type' => 'jpg',
            'order' => 0,
        ];

        $kampanya_1->big_image()->create($kampanya_1_image);
        $kampanya_1->small_image()->create($kampanya_1_sm_image);

        $kampanya_2 = [
            'title' => 'Most Popular Pet Shop products',
            'sub_title' => '50 TL discount for 450 TL',
            'url' => '#',
            'image' => 'kampanya_2',
            'sm_image' => 'sm_kampanya_2',
            'order' => 0,
        ];
        $kampanya_2 = $markalar->slidercontents()->create($kampanya_2);

        $kampanya_2_image = [
            'path' => asset('assets/images/slidercontent').'/'.$kampanya_2->image.'.jpg',
            'name' => $kampanya_2->image,
            'type' => 'jpg',
            'order' => 0,
        ];
        $kampanya_2_sm_image = [
            'path' => asset('assets/images/slidercontent').'/'.$kampanya_2->sm_image.'.jpg',
            'name' => $kampanya_2->sm_image,
            'type' => 'jpg',
            'order' => 0,
        ];

        $kampanya_2->big_image()->create($kampanya_2_image);
        $kampanya_2->small_image()->create($kampanya_2_sm_image);

    }
}
