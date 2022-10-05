<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use App\Traits\JsonRespondController;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    use JsonRespondController;

    public function __invoke()
    {
        try {
            $categories = Category::query()
                ->with([
                    'childrenCategories',
                    'childrenCategories.image',
                    'childrenCategories.categories',
                ])
                ->whereStatus(1)
                ->orderBy('name')
                ->where('category_id', null)->get();

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return $this->respond(new CategoryCollection($categories));
    }
}
