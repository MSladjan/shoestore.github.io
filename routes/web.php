<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;




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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [FrontendController::class, 'index']);
Route::get('category', [FrontendController::class, 'category']);
Route::get('category/{slug}', [FrontendController::class, 'viewcategory']);
Route::get('category/{cate_slug}/{prod_slug}', [FrontendController::class, 'productview']);

Route::get('product-list', [FrontendController::class, 'productlistAjax']);
Route::post('searchproduct', [FrontendController::class, 'searchProduct']);
Auth::routes();


Route::get('load-cart-data', [CartController::class, 'cartcount']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('add-to-cart', [CartController::class, 'addProduct']);
Route::post('delete-cart-item', [CartController::class, 'deleteproduct']);
Route::post('update-cart', [CartController::class, 'updatecart']);

Route::middleware(['auth'])->group(function () {
    Route::get('cart', [CartController::class, 'viewcart']);
    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::post('place-order', [CheckoutController::class, 'placeorder']);

    Route::get('my-orders', [UserController::class, 'index']);
    Route::get('view-order/{id}', [UserController::class, 'view']);
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
Route::get('/dashboard',[App\Http\Controllers\Admin\FrontendController::class, 'index'])->name('dashboard');
Route::get('categories',[App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories');
Route::get('add-category',[App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('add-category');
Route::post('insert-category',[App\Http\Controllers\Admin\CategoryController::class, 'insert'])->name('insert-category');
Route::get('edit-category/{id}',[App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit-prod');
Route::put('update-category/{id}',[App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update-category');
Route::get('delete-category/{id}',[App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('delete-category');

Route::get('products',[App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products');
Route::get('add-products',[App\Http\Controllers\Admin\ProductController::class, 'add'])->name('add-products');
Route::post('insert-products',[App\Http\Controllers\Admin\ProductController::class, 'insert'])->name('insert-products');

Route::get('edit-product/{id}',[App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('edit-product');
Route::put('update-product/{id}',[App\Http\Controllers\Admin\ProductController::class, 'update'])->name('update-product');
Route::get('delete-product/{id}',[App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('delete-product');


Route::get('orders', [OrderController::class, 'index' ]);
Route::get('admin/view-order/{id}', [OrderController::class, 'view' ]);
Route::put('update-order/{id}', [OrderController::class, 'updateorder' ]);
Route::get('order-history', [OrderController::class, 'orderhistory' ]);

Route::get('users', [DashboardController::class, 'users']);
Route::get('view-user/{id}', [DashboardController::class, 'viewuser']);
    
});
