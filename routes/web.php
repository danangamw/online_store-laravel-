<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\MyAccountController;

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

/* Home */

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);

/* Product */

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

/* Cart */
Route::get('/cart', [cartController::class, 'index']);
Route::get('/cart/delete', [cartController::class, 'delete']);
Route::post('/cart/add/{id}', [cartController::class, 'add']);
Route::get('/cart/purchase', [cartController::class, 'purchase']);

/* Account */
Route::get('/my-account/orders', [MyAccountController::class, 'orders']);

/* Admin */
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminHomeController::class, 'home']);
    Route::get('/admin/products', [AdminProductController::class, 'index']);
    Route::post('/admin/products/store', [AdminProductController::class, 'store']);
    Route::delete('/admin/products/{id}/delete', [AdminProductController::class, 'delete']);
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit']);
    Route::put('/admin/products/{id}/update', [AdminProductController::class, 'update']);
});

Auth::routes();
