<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{

    use JsonRespondController;

    /**
     * Display a list of the Products.
     *
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $category               = $request->query('category') ?? null;
        $brand                  = $request->query('brand') ?? null;

        // True or False Products with Colors.
        $color                  = $request->query('color') ?? false;
        $size                   = $request->query('size') ?? false;

        try {
            $products = Product::with(['shortproduct_image']);
            $products_count = $products->count();
            $products = $products
                ->when($color != false, function (Builder $q) use ($color) {
                    return $q
                        ->where('extra_attributes->color', '!=', '[]');
                })
                ->when($size != false, function (Builder $q) use ($size) {
                    return $q
                        ->where('extra_attributes->size', '!=', '[]');
                })
                ->when($brand != null, function (Builder $q) use ($brand) {
                    return $q
                        ->where('brand_id', $brand);
                })
                ->when($category != null, function (Builder $q) use ($category) {
                    $cat       = Category::findOrFail($category);

                    return $cat->products_in_category(
                        query: $q,
                    );
                })
                ->search(
                    needle: $request->query('search_keyword') ?? '',
                    orderByColumn: $request->query('order_field') ?? 'id',
                    orderByDirection: $request->query('order_type') ?? 'ASC',
                )
                ->paginate($request->query('products_per_page') ?? 1);

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return ProductResource::collection($products)->additional([
            'products_count' => $products_count,
        ]);
    }

    /**
     * @throws Exception
     */
    public function store(ProductRequest $request): JsonResponse|ProductResource
    {
        try {
            $data = $request->validated();
            $slug = Str::slug($data['name']);
            $cities = ['konya', 'istanbul'];
            $city = strtolower($data['city']);
            if ( ! in_array($city, $cities) ) {
                throw new Exception('Validation Error city should be one of (konya, istanbul).');
            }

            $extra_attributes = (empty($data['extra_attributes']))
                ? json_decode($data['extra_attributes'])
                : ['color' => [],'size' => [],];

            $cost  = $data['cost'];
            $price = (($cost * 80) / 100) + $cost;

            $data = [
                'name' => $data['name'],
                'slug' => $slug,
                'code' => $data['code'],
                'city' => $city,
                'serial' => $data['serial'],
                'amount' => $data['amount'],
                'price' => $price,
                'cost' => $cost,
                'description' => $data['description'],
                'extra_attributes' => $extra_attributes,
                'bill_id' => 1,
                'brand_id' => $data['brand_id'],
                'seller_id' => $data['seller_id'],
                'category_id' => $data['category_id'],
                'contribution_id' => 1,
                'user_id' => 1,
            ];

            $product = Product::create($data);

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return (new ProductResource($product));
    }

    /**
     * @param ProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request, int $id): JsonResponse
    {
        try {
            $data = $request->validated();

            if (in_array('name', array_keys($data))) {
                $data += ['slug' => Str::slug($data['name'])];
            }

            $product = Product::findOrFail($id)->update($data);

        } catch (ModelNotFoundException) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e->getMessage());
        }

        return $this->respond(new ProductResource($product));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound([$e->getMessage()]);
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return $this->respondObjectDeleted($id);
    }


}
