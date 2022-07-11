<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the Products, Products Count, Products Type Count,
     * Total Products Costs.
     *
     * @param Request $request
     * @return ProductCollection
     */
    public function index(Request $request): ProductCollection
    {
        $search_field   = $request->query('search_field') ?? 'code';
        $search_keyword = $request->query('search_keyword') ?? '';
        $order_field    = $request->query('order_field') ?? 'id';
        $order_type     = $request->query('order_type') ?? 'ASC';
        $per_page       = $request->query('per_page') ?? 5;

        $products = Product::where($search_field, "like", "%$search_keyword%")
            ->orderBy($order_field, $order_type);

        $products_in_stock_count = 0;
        $products_total_costs    = 0;
        $products_types_count    = $products->count();

        foreach ($products->get() as $product) {
            if ($product->id != 1) {
                $products_total_costs    += $product->cost * $product->amount;
                $products_in_stock_count += $product->amount;
            }
        }

        return (new ProductCollection($products->paginate($per_page)))->additional([
            'meta' => [
                'products_in_stock_count' => $products_in_stock_count,
                'products_total_costs'    => $products_total_costs,
                'products_types_count'    => $products_types_count,
                'search_field'            => $search_field,
                'search_keyword'          => $search_keyword,
                'per_page'                => $per_page,
            ]
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * you can't update cost, amount, Bill, Contribution, created_at, User_id
     * Only Name, Code, Price, Serial, Description, Seller, Brand, Category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $except_fields = ['cost', 'amount', 'bill_id', 'contribution_id', 'created_at', 'user_id'];

        if ($request->has($except_fields)) {
//            return response()->json()
        }
    }

    public function show($id)
    {
        return (new ProductResource(Product::findOrFail($id)));
    }
}
