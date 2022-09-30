<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ShopComponenet extends Component
{
    public $products, $categories;
    public string $searchKeyword = '';
    public string $productSortBy = '';

    protected $queryString = [
        'searchKeyword' => ['except' => '']
    ];

    public function render()
    {
        $orderBy          = (empty($this->productSortBy))?['price', 'asc']:explode('.', $this->productSortBy);
        $orderByColumn    = $orderBy[0];
        $orderByDirection = $orderBy[1];
        $this->categories = Category::all();

        $products = Product::query();

        $products = $products
            ->where([
                ['code', 'NOT LIKE', 'PR%'],
                ['code', 'NOT LIKE', 'GL%'],
                ['code', 'NOT LIKE', 'RPR%'],
                ['code', 'NOT LIKE', 'GBB%'],
            ]);

        $products->search(
            needle: $this->searchKeyword,
            orderByColumn: $orderByColumn,
            orderByDirection: $orderByDirection,
        );

        return view('livewire.frontend.shop-componenet', [
            'paginated' => $products->paginate(50),
        ])
            ->layout('layouts.frontend.app', [
                'header' => $this->setHeader(),
            ]);
    }

    public function  setHeader(): array
    {
        return [
            'page_title' => 'shop',
            'breadcrumb' => [
                'routes' => [
                    'home' => 'frontend.home',
                    'shop' => 'frontend.shop',
                    'all_products'  => 'frontend.shop',
                ],
            ]
        ];
    }
}
