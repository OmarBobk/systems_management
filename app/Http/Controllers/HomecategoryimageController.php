<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use App\Traits\JsonRespondController;
use Illuminate\Http\Request;

class HomecategoryimageController extends Controller
{
    use JsonRespondController;

    public function __invoke()
    {
        try {
            $categories = Category::query()
                ->with(['image'])
                ->whereNot('category_id', null)
                ->whereStatus(1)
                ->limit(15)
                ->get();

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return $this->respond(new CategoryCollection($categories));
    }
}
