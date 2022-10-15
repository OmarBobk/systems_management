<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class HomeComponenet extends Component
{
    public function render()
    {
        return view('livewire.frontend.home-componenet')
            ->layout('layouts.frontend.app', [
                'header' => $this->setHeader(),
            ]);
    }

    public function  setHeader(): array
    {
//        [
//            'page_title' => 'home',
//            'breadcrumb' => [
//                'routes' => [
//                    'home' => 'frontend.home',
//                    'shop' => 'frontend.shop'
//                ],
//            ]
//        ]
        return [
            'page_title' => 'home',
        ];
    }
}
