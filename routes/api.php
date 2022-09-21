<?php

use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\ProductsController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products', ProductsController::class)
    ->only(['index', 'update']);
Route::apiResource('categories', CategoryController::class)
    ->only(['index', 'update', 'store', 'destroy', 'show']);


Route::fallback(function() {
   return response()->json([
       'message' => 'Page Not Found. If error Persists, Contact ahmadomarbobk@gmail.com',
   ]);
});
