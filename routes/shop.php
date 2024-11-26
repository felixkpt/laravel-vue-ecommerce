<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HeaderSearchController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\SearchController;

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::post('/shop/cart', [ShopController::class, 'store']);
Route::post('/shop/orderby', [ShopController::class, 'orderby']);
Route::post('/shop/per-page', [ShopController::class, 'perPage']);
Route::post('/shop/price-sort', [ShopController::class, 'priceSort']);
Route::post('/shop/viewType', [ShopController::class, 'viewType']);

Route::get('/cart', [CartController::class, 'index'])->name('shop.cart');
Route::post('/cart/json', [CartController::class, 'json'])->name('shop.cart.json');
Route::post('/cart/increase', [CartController::class, 'increaseQuantity'])->name('shop.cart.increase');
Route::post('/cart/decrease', [CartController::class, 'decreaseQuantity'])->name('shop.cart.decrease');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('shop.cart.remove');
Route::post('/cart/destroy', [CartController::class, 'destroy'])->name('shop.cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/product/{slug}', [ProductDetailsController::class, 'index'])->name('product.details');
Route::get('/product-category/{category_slug}', [CategoryController::class, 'index'])->name('product.category');

Route::get('/search', [SearchController::class, 'index'])->name('product.search.index');
Route::get('/search/list', [SearchController::class, 'list'])->name('product.search.list');
Route::post('/search/orderby', [SearchController::class, 'orderby'])->name('product.search.orderby');
Route::post('/search/post-per-page', [SearchController::class, 'postPerPage'])->name('product.search.postPerPage');

Route::get('products', [ProductController::class, 'index']);
Route::get('categories/list', [CategoryController::class, 'list'])->name('categories.list');
Route::get('products/popular', [ProductController::class, 'popular']);
