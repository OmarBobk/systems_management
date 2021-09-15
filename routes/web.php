<?php

use Illuminate\Support\Facades\Route;

Route::get('/testing', \App\Http\Livewire\TestingComponent::class);



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

    })->name('home');

    Route::get('dashboard', function () {
        $is_admin = Auth::user()->is_admin;

        if ($is_admin) {
            return redirect(route('admin.dashboard'));
        } else {
            return redirect(route('user.dashboard'));
        }

    })->name('dashboard');



    Route::get('/products',         App\Http\Livewire\ProductsComponent::class)      ->name('products');
    Route::get('/categories',       App\Http\Livewire\CategoryComponent::class)      ->name('categories');
    Route::get('/cashier',          App\Http\Livewire\CashierComponent::class)       ->name('cashier');
    Route::get('/sales',            App\Http\Livewire\SaleComponent::class)          ->name('sales');
    Route::get('/debts-management', App\Http\Livewire\DebtManagementComponent::class)->name('debts');

    // Users
    Route::middleware('userAuth')
        ->name('user.')
        ->prefix('user')
        ->group(function () {
        Route::get('/dashboard', App\Http\Livewire\User\UserDashboardComponent::class)->name('dashboard');
    });

    // Admins
    Route::middleware('adminAuth')
        ->name('admin.')
        ->prefix('admin')
        ->group(function () {
        Route::get('/dashboard', App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('dashboard');
    });
});
