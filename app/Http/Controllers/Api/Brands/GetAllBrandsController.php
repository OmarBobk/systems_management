<?php

namespace App\Http\Controllers\Api\Brands;

use App\Http\Controllers\Controller;
use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetAllBrandsController extends Controller
{
    use JsonRespondController;

    public function __invoke(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $category        = $request->query('category') ?? null;
        $brands_per_page = $request->query('brands_per_page') ?? 5;
        try {
            $brands = Brand::query()
                ->when($category != null, function ($q) use ($category) {
                    $cat       = Category::findOrFail($category);
                    $childrens = $cat->childrenCategories;

                    if ($childrens->isEmpty())
                        // The Category has no childrens
                        return $q->whereIn('id', array_values(array_unique($cat->products()->pluck('brand_id')->toArray())));
                    else
                        if ($cat->parent != null) {
                            // Category has children and Parent

                            // products_in_parent_category
                            return $q->whereIn('id', array_values(array_unique($cat->products_in_parent_category()->pluck('brand_id')->toArray())));
                        } else {
                            // Category is a Grand father category.
                            throw new Exception('It\'s not available to Make The Request By a Grand Father Category, it either a parent category or a son category');
                        }
                })
                ->paginate($brands_per_page);

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return BrandResource::collection($brands);
    }
}
