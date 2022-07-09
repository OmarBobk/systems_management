<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the Products.
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

        return (new ProductCollection($products->paginate(5)))->additional([
            'meta' => [
                'products_in_stock_count' => $products_in_stock_count,
                'products_total_costs'    => $products_total_costs,
                'products_types_count'    => $products_types_count,
                'search_field'            => $search_field,
                'search_keyword'          => $search_keyword,
            ]
        ]);
    }

    /**
     * Send The Important Information for creating New Product
     * form.
     *
     * @param Request $request
     * @return void
     */
    public function create_form_infos(Request $request)
    {

        $bill_id = $request->query('bill_id') ?? 0;
        $bill    = Bill::find(($bill_id != null and $bill_id > 0) ? $bill_id : 1);

        $seller_id = $bill->seller;
        $brand_id  = 2;
        $contributor_id = 2;
        $contribution_id = 3;
        $categories = Category::all();

        return (new ProductCollection())

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
