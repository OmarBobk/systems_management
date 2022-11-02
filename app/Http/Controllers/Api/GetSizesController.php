<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class GetSizesController extends Controller
{
    use JsonRespondController;

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $category = $request->query('category');
            $cat       = Category::find($category);
            if (!$cat) {
                return $this->respondInvalidParameters('Request Should have category id parameter.');
            }
            $childrens = $cat->childrenCategories;

            if ($childrens->isEmpty()) {
                // The Category has no childrens
                $products = $cat->products()->whereNotNull('extra_attributes->size')->get();
            } else {
                if ($cat->parent != null) {
                    // Category has children and Parent
                    $products = $cat->products_in_parent_category()->whereNotNull('extra_attributes->size')->get();
                } else {
                    // Category is a Grand father category.
                    throw new Exception('It\'s not available to Make The Request By a Grand Father Category, it either a parent category or a son category');
                }
            }

            if ($products->isEmpty()) {
                // no attributes for this category products
                throw new Exception('There is no Size attributes for this category products');
            }

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        $sizes = [];
        foreach ($products as $product) {
            $sizes += $product->sizes();
        }
        return $this->respond($sizes);

    }
}
