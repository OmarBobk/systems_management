<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\ProductsComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

Route::get('/testing', function () {
    $is_admin = (Auth::user() == null) ? redirect(route('login')) : Auth::user()->is_admin;

    return $is_admin;

});



// Users and Admins
Route::group([
    'middleware' => ['auth:sanctum', 'verified'],
], function() {

    // Admins & Users
    Route::get('/', function () {
        $is_admin = Auth::user()->is_admin;

        if ($is_admin) {
            return redirect(route('admin.dashboard'));
        } else {
            return redirect(route('user.dashboard'));
        }

    });
    Route::get('/products', ProductsComponent::class)->name('products');
    Route::get('/categories', CategoryComponent::class)->name('categories');

    // Users
    Route::middleware('userAuth')
        ->name('user.')
        ->prefix('user')
        ->group(function () {
        Route::get('/dashboard', UserDashboardComponent::class)->name('dashboard');
    });

    // Admins
    Route::middleware('adminAuth')
        ->name('admin.')
        ->prefix('admin')
        ->group(function () {
        Route::get('/dashboard', AdminDashboardComponent::class)->name('dashboard');
    });
});
