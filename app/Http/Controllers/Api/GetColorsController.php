<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetColorsController extends Controller
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
                $products = $cat->products()->whereNotNull('extra_attributes->color')->get();
            } else {
                if ($cat->parent != null) {
                    // Category has children and Parent
                    $products = $cat->products_in_parent_category()->whereNotNull('extra_attributes->color')->get();
                } else {
                    // Category is a Grand father category.
                    throw new Exception('It\'s not available to Make The Request By a Grand Father Category, it either a parent category or a son category');
                }
            }

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        $colors = [];
        foreach ($products as $product) {
            $colors += $product->colors();
        }
        return $this->respond($colors);

    }

}
