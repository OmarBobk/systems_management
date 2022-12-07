<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BrandsRequest;
use App\Http\Requests\Backend\SellersRequest;
use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Sellers\SellerResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Seller;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class SellerController extends Controller
{

    use JsonRespondController;

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     * @throws Exception
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $category        = $request->query('category') ?? null;
        $brands_per_page = $request->query('sellers_per_page') ?? 5;
        try {
            $sellers = Seller::query()->with(['brands'])
                ->when($category != null, function ($q) use ($category) {
                    $cat       = Category::findOrFail($category);
                    $childrens = $cat->childrenCategories;

                    if ($childrens->isEmpty())
                        // The Category has no children
                        return $q->whereIn('id', array_values(array_unique($cat->products()->pluck('seller_id')->toArray())));
                    else
                        if ($cat->parent != null) {
                            // Category has children and Parent

                            // products_in_parent_category
                            return $q->whereIn('id', array_values(array_unique($cat->products_in_parent_category()->pluck('seller_id')->toArray())));
                        } else {
                            // Category is a Grand father category.
                            throw new Exception('It\'s not available to Make The Request By a Grand Father Category, it either a parent category or a son category');
                        }
                })
                ->paginate($brands_per_page);

        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound([$e->getMessage()]);
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return SellerResource::collection($sellers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SellersRequest $request
     * @return JsonResponse
     */
    public function store(SellersRequest $request): JsonResponse
    {
        try {
            $seller = Seller::create($request->validated());
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return $this->respond((new SellerResource($seller)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $seller = Seller::with(['brands'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound([$e->getMessage()]);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e->getMessage());
        }

        return $this->respond((new SellerResource($seller)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SellersRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(SellersRequest $request, int $id): JsonResponse
    {
        try {
            $data = $request->validated();

            $seller = Seller::with('brands')->findOrFail($id);
            $seller->update($data);

        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound([$e->getMessage()]);
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return $this->respond((new SellerResource($seller)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $brand = Seller::findOrFail($id);
            $brand->delete();

        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound([$e->getMessage()]);
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e->getMessage());
        }

        return $this->respondObjectDeleted($id);
    }
}
