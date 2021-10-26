<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/testing', \App\Http\Livewire\TestingComponent::class);
Route::get('/testing', function () {
    dd( \App\Models\Contributor::with(['contributions' => function ( $query) {
        $query->withSum('profits', 'amount');
    }])->get()->first());
//    return \App\Models\Contributor::all()->first()->contributions;
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

    })->name('home');

    Route::get('dashboard', function () {
        $is_admin = Auth::user()->is_admin;

        if ($is_admin) {
            return redirect(route('admin.dashboard'));
        } else {
            return redirect(route('user.dashboard'));
        }

    })->name('dashboard');



    Route::get('/products',                 App\Http\Livewire\ProductsComponent::class)      ->name('products');
    Route::get('/categories',               App\Http\Livewire\CategoryComponent::class)      ->name('categories');
    Route::get('/cashier',                  App\Http\Livewire\CashierComponent::class)       ->name('cashier');
    Route::get('/sales',                    App\Http\Livewire\SaleComponent::class)          ->name('sales');
    Route::get('/debts-management',         App\Http\Livewire\DebtManagementComponent::class)->name('debts');
    Route::get('/sellers',                  App\Http\Livewire\SellerComponent::class)        ->name('sellers');
    Route::get('/contributions-management', App\Http\Livewire\Contributions::class)          ->name('contributions');
    Route::get('/safe',                     App\Http\Livewire\SafeComponent::class)          ->name('safe');

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
