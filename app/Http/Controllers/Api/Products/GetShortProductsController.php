<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\GetShortProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetShortProductsController extends Controller
{
    use JsonRespondController;

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function __invoke(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $search_keyword         = $request->query('search_keyword') ?? '';
        $order_field            = $request->query('order_field') ?? 'id';
        $order_type             = $request->query('order_type') ?? 'ASC';
        $products_per_page      = $request->query('products_per_page') ?? 1;
        $category               = $request->query('category') ?? null;
        $price_min              = $request->query('price_min') ?? null;
        $price_max              = $request->query('price_max') ?? null;
        $brand                  = $request->query('brand') ?? null;
        $categories_with_colors = Category::all()->modelKeys();
        $categories_with_sizes  = Category::all()->modelKeys();
        $color                  = (in_array($category, $categories_with_colors))
            ? $request->query('color')
            : null;
        $size                   = (in_array($category, $categories_with_sizes))
            ? $request->query('size')
            : null;

        try {
            $products = Product::with(['shortproduct_image'])
                ->when($color != null, function (Builder $q) use ($color) {
                    return $q
                        ->whereNotNull('extra_attributes')
                        ->whereJsonContains('extra_attributes->color', ['value' => $color]);
                })
                ->when($size != null, function (Builder $q) use ($size) {

                    return $q
                        ->whereNotNull('extra_attributes')
                        ->whereJsonContains('extra_attributes->size', ['value' => $size]);
                })
                ->when($brand != null, function (Builder $q) use ($brand) {
                    return $q
                        ->where('brand_id', $brand);
                })
                ->when($category != null, function (Builder $q) use ($category) {
                    $cat       = Category::findOrFail($category);
                    $childrens = $cat->childrenCategories;

                    if ($childrens->isEmpty())
                        // The Category has no childrens
                        return $q->where('category_id', $category);
                    else
                        if ($cat->parent != null) {
                            // Category has children and Parent
                            return $q->whereIn('category_id', $childrens->modelKeys());
                        } else {
                            // Category is a Grand father category.
                            throw new \Exception('It\'s not available to get Products By a Grand Father Category, it either a parent category or a son category');
                        }
                })
                ->when(($price_min or $price_max), function (Builder $q) use ($price_min, $price_max) {
                    return $q->whereBetween('price', [
                        ($price_min ?? 0) * 100,
                        ($price_max ?? 9999) * 100
                    ]);
                })
                ->search(
                    needle: $search_keyword,
                    orderByColumn: $order_field,
                    orderByDirection: $order_type,
                )
                ->paginate($products_per_page);

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return GetShortProductResource::collection($products);
    }
}
