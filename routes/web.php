<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/testing', \App\Http\Livewire\TestingComponent::class);
Route::get('/testing', \App\Http\Livewire\TestingComponent::class)->name('testing');


// Users and Admins
Route::group([
    'middleware' => ['auth:sanctum', 'verified'],
], function() {

    // Admins & Users
    Route::get('/', function () {
        $is_admin = Auth::user()->is_admin;

        if ($is_admin) {
            return redirect(route('cashier'));
        } else {
            return redirect(route('cashier'));
        }

    })->name('home');

    Route::get('dashboard', function () {
        $is_admin = Auth::user()->is_admin;

        if ($is_admin) {
            return redirect(route('cashier'));
        } else {
            return redirect(route('cashier'));
        }

    })->name('dashboard');



    Route::get('/products',                 App\Http\Livewire\ProductsComponent::class)                 ->name('products');
    Route::get('/categories',               App\Http\Livewire\CategoryComponent::class)                 ->name('categories');
    Route::get('/cashier',                  App\Http\Livewire\CashierComponent::class)                  ->name('cashier');
    Route::get('/sales',                    App\Http\Livewire\SaleComponent::class)                     ->name('sales');
    Route::get('/debts-management',         App\Http\Livewire\DebtManagementComponent::class)           ->name('debts');
    Route::get('/sellers',                  App\Http\Livewire\SellerComponent::class)                   ->name('sellers');
    Route::get('/contributions-management', App\Http\Livewire\Contributions::class)                     ->name('contributions');
    Route::get('/safe',                     App\Http\Livewire\SafeComponent::class)                     ->name('safe');
    Route::get('/incomes',                  App\Http\Livewire\IncomeComponent::class)                   ->name('incomes');
    Route::get('/incomes/{income}', function ($income) {
        dd($income);
    })                   ->name('incomes.view');
    Route::get('/expenses',                 App\Http\Livewire\ExpensesComponent::class)                 ->name('expenses');
    Route::get('/bills',                    App\Http\Livewire\BillComponent::class)                     ->name('bills');
    Route::get('/products-container/{productsContainer}',       App\Http\Livewire\ProductsContainerComponent::class)        ->name('container');
    Route::get('/container-manager',        App\Http\Livewire\ContainersManagerComponent::class)        ->name('containers-manager');
//    Route::get('/debtors',                    function () {
//        return view('livewire.debtorpowergrid')->layout('layouts.user');
//    })      ->name('debtors');

    Route::get('/contributor/{contributor}', \App\Http\Livewire\ContributorComponent::class)->name('contributor');
    Route::get('/products-database', \App\Http\Livewire\ProductsDatabaseComponent::class)->name('productsdatabase');

    Route::view('/powergrid', 'powergrid-demo');

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
