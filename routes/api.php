<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\HomeController;
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



Route::prefix('v1')
    ->name('api.v1.')
    ->group(function () {

        Route::post('/url_list', [ApiController::class, 'success'])->name('url_list');
        Route::post('homepage', HomeController::class)->name('homepage');

        Route::prefix('auth')
            ->name('auth.')
            ->group(function () {
                Route::post('register', [AuthController::class, 'register'])->name('register');
                Route::post('login', [AuthController::class, 'login'])->name('login');
                Route::post('verify-email', [AuthController::class, 'verify_email'])->name('verify-email')->middleware('auth:sanctum');
                Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
            });

        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::get('test', function() {
                    return response()->json([
                        'message' => "HEy there"
                    ]);
                });
            });

        Route::apiResource('products', ProductsController::class)
            ->only(['index', '']);
        Route::apiResource('categories', CategoryController::class)
            ->only(['index', 'update', 'store', 'destroy', 'show']);

        // Lists of lists like: List of all products or categories.
        Route::prefix('lists')
            ->name('list.')
            ->group(function () {

                // name api.v1.list.categories
                // rui /api/v1/list/categories
                Route::get('categories', function () {})->name('categories');

            });

});


Route::fallback(function() {
   return response()->json([
       'message' => 'Page Not Found. If error Persists, Contact ahmadomarbobk@gmail.com',
   ]);
});
