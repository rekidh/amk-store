<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUsers;
use App\Http\Controllers\Product;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductCategory;
use App\Http\Controllers\ProductManagement;
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

Route::get('/', function () {
    return view('pages.login');
});
Route::post('/', [AuthUsers::class, 'login'])->name('login');
Route::post('/logout', [AuthUsers::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

        Route::prefix('orders')->group(
            function () {
                Route::get('/', [OrdersController::class, 'index'])->name('orderProductList');
                Route::post('/submitCustomer', [OrdersController::class, 'submitCustomer'])->name('submitCustomer');
                Route::get('/listCustomer', [OrdersController::class, 'listCustomer'])->name('listCustomer');
                Route::post('/addOrderCustomer', [OrdersController::class, 'submitOrderItem'])->name('submitOrderItem');
                Route::post('/submitOder/{uuid}', [OrdersController::class, 'submitOrder'])->name('submitOrder');
                Route::delete('/deleteOrderItem/{orderItemId}', [OrdersController::class, 'deleteOrderItem'])->name('deleteOrderItem');
                Route::delete('/order/{orderId}', [OrdersController::class, 'deleteOrder'])->name('deleteOrder');
                Route::get('/api/product', [OrdersController::class, 'apiProduct'])->name('apiProduct');
            }
        );

        Route::prefix('product')->group(
            function () {
                Route::get('/', [Product::class, 'index'])->name('showProduct');

                Route::prefix('management')->group(
                    function () {
                        Route::get('/', [ProductManagement::class, 'index'])->name('showManagementProduct');
                        Route::post('/', [ProductManagement::class, 'createProduct'])->name('createProduct');
                        Route::get('/{uuid}/edit', [ProductManagement::class, 'edit'])->name('editProduct');
                        Route::put('/{uuid}', [ProductManagement::class, 'update'])->name('updateProduct');
                        Route::delete('/{uuid}', [ProductManagement::class, 'deleteProduct'])->name('deleteProduct');
                    }
                );
                Route::prefix('category')->group(
                    function () {
                        Route::get('/', [ProductCategory::class, 'index'])->name('showCategory');
                        Route::post('/', [ProductCategory::class, 'createCategory'])->name('createCategory');
                        Route::get('/{uuid}/edit', [ProductCategory::class, 'edit'])->name('categoryEdit');
                        Route::put('/{uuid}', [ProductCategory::class, 'update'])->name('categoryUpdate');
                        Route::delete('/{uuid}', [ProductCategory::class, 'deleteCategory'])->name('deleteCategory');
                    }
                );
            }
        );
    }
);
