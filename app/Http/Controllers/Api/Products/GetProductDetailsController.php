<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\GetShortProductResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetProductDetailsController extends Controller
{
    use JsonRespondController;

    /**
     * @param int $id
     * @return ProductResource|JsonResponse
     */
    public function __invoke(int $id): JsonResponse|ProductResource
    {
        try {
            $product = Product::with(['images', 'brand', 'category'])->findOrFail($id);

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return new ProductResource($product);
    }
}
