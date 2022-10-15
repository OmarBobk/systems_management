<?php

namespace App\Http\Controllers;

use App\Http\Resources\Productsection\ProductsectionCollection;
use App\Models\Productsection;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetHomeProductsController extends Controller
{
    use JsonRespondController;

    public function __invoke(Request $request): JsonResponse|ProductsectionCollection
    {
        $per_page             = $request->query('per_page') ?? 5;
        $products_per_section = $request->query('products_per_section') ?? 5;
        try {
            $productsections = Productsection::with([
                'products' => function ($q) use ($products_per_section) { $q->limit($products_per_section); },
                'products.shortproduct_image',

            ])
                ->paginate($per_page);

        } catch (\Throwable $th) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }

        return new ProductsectionCollection($productsections);
    }
}
