<?php

namespace App\Http\Controllers\Api\Brands;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BrandsRequest;
use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
use App\Models\Category;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class BrandsController extends Controller
{
    use JsonRespondController;

    /**
     * Get All Brands by Category with Paginating
     *
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $category        = $request->query('category') ?? null;
        $brands_per_page = $request->query('brands_per_page') ?? 5;
        try {
            $brands = Brand::query()
                ->when($category != null, function ($q) use ($category) {
                    $cat       = Category::findOrFail($category);
                    $childrens = $cat->childrenCategories;

                    if ($childrens->isEmpty())
                        // The Category has no children
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

    /**
     * Create New Brand
     *
     * @param BrandsRequest $request
     * @return JsonResponse|BrandResource
     */
    public function store(BrandsRequest $request): JsonResponse|BrandResource
    {
        try {
            $brand = Brand::create($request->validated());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound([$e->getMessage()]);
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return (new BrandResource($brand))->additional([
            'description' => $brand->description,
        ]);

    }

    /**
     * @param BrandsRequest $request
     * @param int $id
     * @return JsonResponse|BrandResource
     */
    public function update(BrandsRequest $request, int $id): JsonResponse|BrandResource
    {
        try {
            $data = $request->validated();

            $brand = Brand::findOrFail($id);
            $brand->update($data);

        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound([$e->getMessage()]);
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return (new BrandResource($brand))->additional([
            'description' => $brand->description,
        ]);
    }

    /**
     * Delete the given brand.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();

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
