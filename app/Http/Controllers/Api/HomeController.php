<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use JsonRespondController;
//
//    public function categories()
//    {
//        try {
//            $categories = Category::with(['childrenCategories'])
//                ->where('category_id', null)->get();
//
//        } catch (\Throwable $throwable) {
//            return $this->respondInvalidQuery([
//                'status' => false,
//                'message' => $throwable->getMessage()
//            ]);
//        }
//
//        return $this->respond((new CategoryCollection($categories)));
//    }


    public function __invoke(): JsonResponse
    {
        try {
            $categories = Category::query();
            $navbar_categories = $categories
                ->with(['childrenCategories'])
                ->where('category_id', null)->get();

            $categories_with_images = $categories->get();
            $home_sliders = '';
            $newest_products = '';

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return $this->respond([
            'navbar_categories' => (new CategoryCollection($navbar_categories)),
//            'categories_with_images' => (new CategoryCollection($categories_with_images))
        ]);
    }
}
