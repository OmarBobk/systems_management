<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('stock', function () {
//        dd('Test');
//})->domain('test.'.env('APP_URL'))->name('omar');

Route::name('backend.')
    ->prefix('backend')
    ->middleware(['adminAuth'])
    ->group(function () {

        Route::post('invoice_pdf/{invoicecustomer}/{invoice}', [\App\Http\Livewire\Backend\InvoiceComponent::class, 'export_to_pdf'])->name('invoice_pdf');

        // Backend Dashboard.
        Route::get('dashboard', \App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('dashboard');

        Route::get('test', function() {
            dd('test');
        })->name('test');



        Route::get(
            uri: '/cashier',
            action: App\Http\Livewire\Backend\CashierComponent::class)
            ->name('cashier');

        Route::get(
            uri: '/products',
            action: App\Http\Livewire\Backend\ProductsComponent::class)
            ->name('products');

        Route::get(
            uri: '/categories',
            action: App\Http\Livewire\Backend\CategoryComponent::class)
            ->name('categories');

        Route::get(
            uri: '/debts-management',
            action: App\Http\Livewire\Backend\DebtManagementComponent::class)
            ->name('debts');

        Route::get(
            uri: '/sellers',
            action: App\Http\Livewire\Backend\SellerComponent::class)
            ->name('sellers');

        Route::get(
            uri:'/sales',
            action: App\Http\Livewire\Backend\SaleComponent::class)
            ->name('sales');
        Route::get(
            uri:'/contributions-management',
            action: App\Http\Livewire\Backend\Contributions::class)
            ->name('contributions');
        Route::get(
            uri:'/safe',
            action: App\Http\Livewire\Backend\SafeComponent::class)
            ->name('safe');
        Route::get(
            uri:'/incomes',
            action: App\Http\Livewire\Backend\IncomeComponent::class)
            ->name('incomes');
        Route::get('/incomes/{income}', function ($income) {
            dd($income);
        })
            ->name('incomes.view');
        Route::get(
            uri: '/expenses',
            action: App\Http\Livewire\Backend\ExpensesComponent::class)
            ->name('expenses');
        Route::get(
            uri: '/bills',
            action: App\Http\Livewire\Backend\BillComponent::class)
            ->name('bills');
        Route::get(
            uri: '/products-container/{productsContainer}',
            action: App\Http\Livewire\Backend\ProductsContainerComponent::class)
            ->name('container');
        Route::get(
            uri: '/container-manager',
            action: App\Http\Livewire\Backend\ContainersManagerComponent::class)
            ->name('containers-manager');

        Route::get(
            uri: '/contributor/{contributor}',
            action: App\Http\Livewire\Backend\ContributorComponent::class)
            ->name('contributor');
        Route::get(
            uri: '/products-database',
            action: App\Http\Livewire\Backend\ProductsDatabaseComponent::class)
            ->name('productsdatabase');

        Route::get(
            uri: '/invoices',
            action: App\Http\Livewire\Backend\InvoiceComponent::class)
            ->name('invoices');


    });

Route::name('frontend.')
    ->group(function () {
        Route::get(
            uri: '/',
            action: \App\Http\Livewire\Frontend\HomeComponenet::class
        )->name('home');

        Route::get(
            uri: 'shop',
            action: \App\Http\Livewire\Frontend\ShopComponenet::class
        )->name('shop');

        Route::get(
            uri: 'contactus',
            action: function () {dd('This is contact us');}
        )->name('contactus');

        Route::get(
            uri: 'faq',
            action: function () {dd('This is faq');}
        )->name('faq');
    });

//Route::get('/testing', \App\Http\Livewire\TestingComponent::class);
Route::get('/testing', function (\Illuminate\Http\Request $request) {})->name('testing');

// Admins & Users
//Route::get('/', function () {
//
//    if (Auth::check()) {
//        return redirect(route('backend.cashier'));
//    } else {
//        return redirect(route('login'));
//    }
//
//})->name('home');


// Users and Admins
Route::group([
    'middleware' => ['adminAuth'],
], function() {
    // Users
    Route::middleware('userAuth')
        ->name('user.')
        ->prefix('user')
        ->group(function () {
        Route::get('/dashboard', App\Http\Livewire\User\UserDashboardComponent::class)->name('dashboard');
    });

    // Admins
//    Route::middleware('adminAuth')
//        ->name('admin.')
//        ->prefix('admin')
//        ->group(function () {
//        Route::get('/dashboard', App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('dashboard');
//    });
});

//Route::fallback(function() {
//
//    return response(['error' => true, 'error-msg' => 'Not found'], 404);
//
//});
