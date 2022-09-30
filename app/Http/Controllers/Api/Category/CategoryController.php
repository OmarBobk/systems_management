<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class
CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection|string
     */
    public function index(Request $request): AnonymousResourceCollection|string
    {
        $search_field            = $request->query('search_field') ?? 'name';
        $search_keyword          = $request->query('search_keyword') ?? '';
        $order_field             = $request->query('order_field') ?? 'id';
        $order_type              = $request->query('order_type') ?? 'ASC';
        $categories_per_page     = $request->query('categories_per_page') ?? 5;

        try {
            $categories = Category::with(['products'])->where($search_field, "like", "%$search_keyword%")
                ->orderBy($order_field, $order_type);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return CategoryResource::collection($categories->paginate($categories_per_page));
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request): CategoryResource
    {
        try {
            $request->validated();
            $category = Category::create([
                'name' => ucfirst($request->name),
                'slug' => Str::slug($request->name),
            ]);
            return new CategoryResource($category);
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(CategoryRequest $request, Category $category): CategoryResource
    {
        try {
            // Update the product.
            $category->update([
                'name' => ucfirst($request->name),
                'slug' => Str::slug($request->name),
            ]);
            return new CategoryResource($category);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */
    public function destroy(Category $category)
    {

        try {
            $category->delete();
            return response()->noContent();
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }

    }
}
