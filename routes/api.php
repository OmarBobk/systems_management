<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\Home\NavbarController;
use App\Http\Controllers\Api\Home\SliderController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NewPasswordController;
use App\Http\Controllers\Api\PasswordResetLinkController;
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

Route::middleware('auth:sanctum', 'verified')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')
    ->name('api.v1.')
    ->group(function () {

        Route::post('/url_list', [ApiController::class, 'success'])->name('url_list');

        Route::prefix('homepage')
            ->group(function () {
                Route::post('navbar', NavbarController::class);
                Route::post('sliders', SliderController::class);
//                Route::post('sliders/{slider}/slidercontent', HomeController::class);
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
