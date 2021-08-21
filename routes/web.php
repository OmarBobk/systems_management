<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\TestingComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'middleware' => ['auth:sanctum', 'verified'],
], function() {

    Route::get('/', function () {
        $is_admin = Auth::user()->is_admin;

        if ($is_admin) {
            return redirect(route('admin.dashboard'));
        } else {
            return redirect(route('user.dashboard'));
        }

    });

    Route::name('user.')
        ->prefix('user')
        ->group(function () {
        Route::get('/dashboard', UserDashboardComponent::class)->name('dashboard');
    });

    Route::name('admin.')
        ->prefix('admin')
        ->group(function () {
        Route::get('/dashboard', AdminDashboardComponent::class)->name('dashboard');
    });
});
