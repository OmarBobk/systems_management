<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetProductsController extends Controller
{
    use JsonRespondController;

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function __invoke(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $search_keyword          = $request->query('search_keyword') ?? '';
        $order_field             = $request->query('order_field') ?? 'id';
        $order_type              = $request->query('order_type') ?? 'ASC';
        $products_per_page       = $request->query('products_per_page') ?? 1;
        $category                = $request->query('category') ?? null;

        try {
            $products = Product::with(['category', 'brand', 'images'])
                ->search(
                    needle: $search_keyword,
                    orderByColumn: $order_field,
                    orderByDirection: $order_type,
                )
                ->when($category, function ($q) use ($category) {
                    return $q->where('category_id', $category);
                })->paginate($products_per_page);

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return ProductResource::collection($products)->additional([
            'category' => $category,
        ]);
    }

}
