<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\GetuserController;
use App\Http\Controllers\Api\Home\NavbarController;
use App\Http\Controllers\Api\Home\SliderController;
use App\Http\Controllers\Api\Products\GetProductsController;
use App\Http\Controllers\Api\Products\GetShortProductsController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\GetHomeProductsController;
use App\Http\Controllers\HomecategoryimageController;
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

Route::middleware('auth:sanctum', 'verified')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')
    ->name('api.v1.')
    ->group(function () {

        Route::post('/url_list', [ApiController::class, 'success'])->name('url_list');

        Route::prefix('homepage')
            ->group(function () {
                // domain.com/api/v1/homepage/
                Route::post('navbar', NavbarController::class);
                Route::post('sliders', SliderController::class);
                Route::post('categories', HomecategoryimageController::class);
                Route::post('products', GetHomeProductsController::class);
            });

        Route::prefix('auth')
            ->name('auth.')
            ->group(function () {
                Route::post('register', [AuthController::class, 'register'])->name('register');
                Route::post('login', [AuthController::class, 'login'])->name('login');
                Route::middleware('auth:sanctum')
                    ->group(function () {
                        Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail']);
                        Route::get('email/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
                        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
                    });

                Route::post('/forgot-password', PasswordResetLinkController::class)
                    ->name('password.email');

                Route::post('/reset-password', NewPasswordController::class)
                    ->name('password.update');
            });

        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::post('get-user', GetuserController::class);

                Route::post('test', function (Request $request) {
                    dd($request->bearerToken());
                });
            });

        // api/v1/
        Route::prefix('products')
            ->group(function () {
                Route::post('/', GetShortProductsController::class);
            });

        Route::apiResource('categories', CategoryController::class)
            ->only(['index', 'update', 'store', 'destroy', 'show']);

        // Brands API

        // All Brands
        Route::post('brands', \App\Http\Controllers\Api\Brands\GetAllBrandsController::class);

        // All Colors and Sizes
        Route::post('colors', \App\Http\Controllers\Api\GetColorsController::class);
        Route::post('sizes', \App\Http\Controllers\Api\GetSizesController::class);

});


Route::fallback(function() {
   return response()->json([
       'message' => 'Page Not Found. If error Persists, Contact ahmadomarbobk@gmail.com',
   ]);
});
