<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

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
        $search_field            = $request->query('search_field') ?? 'code';
        $search_keyword          = $request->query('search_keyword') ?? '';
        $order_field             = $request->query('order_field') ?? 'id';
        $order_type              = $request->query('order_type') ?? 'ASC';
        $products_per_page       = $request->query('products_per_page') ?? 5;
        $products_in_stock_count = 0;
        $products_total_costs    = 0;

        $products = Product::where($search_field, "like", "%$search_keyword%")
            ->orderBy($order_field, $order_type);


        $products_types_count    = $products->count();

        foreach ($products->get() as $product) {
            if ($product->id != 1) {
                $products_total_costs    += $product->cost * $product->amount;
                $products_in_stock_count += $product->amount;
            }
        }

        return (new ProductCollection($products->paginate($products_per_page)))->additional([
            'meta' => [
                'products_in_stock_count' => $products_in_stock_count,
                'products_total_costs'    => $products_total_costs,
                'products_types_count'    => $products_types_count,
                'search_field'            => $search_field,
                'search_keyword'          => $search_keyword,
                'products_per_page'       => $products_per_page,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * you can't update cost, amount, Bill, Contribution, created_at, User_id
     * Only Name, Code, Price, Serial, Description, Brand, Category.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(ProductRequest $request, Product $product): ProductResource
    {

        $request->validated();
        $except_fields = ['cost', 'amount', 'bill_id', 'contribution_id', 'created_at', 'user_id'];

        foreach ($except_fields as $field) {
            if ($request->has($field)) {
                throw new HttpResponseException(response()->json([
                    'success'   => false,
                    'message'   => 'Validation errors',
                    'data'      => [
                        "$field" => "$field is non editable."
                    ],
                ]));
            }
        }

        try {
            // Update the product.
            $product->update($request->validated());
            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

    }
}
