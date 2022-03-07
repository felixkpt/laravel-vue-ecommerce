<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HeaderSearchController;
use App\Http\Controllers\SearchController;

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::post('/shop/cart', [ShopController::class, 'store']);
Route::post('/shop/orderby', [ShopController::class, 'orderby']);
Route::post('/shop/post-per-page', [ShopController::class, 'postPerPage']);

Route::get('/cart', [CartController::class, 'index'])->name('product.cart');
Route::get('/cart/json', [CartController::class, 'json'])->name('product.cart.json');
Route::post('/cart/increase', [CartController::class, 'increaseQuantity'])->name('product.cart.increase');
Route::post('/cart/decrease', [CartController::class, 'decreaseQuantity'])->name('product.cart.decrease');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('product.cart.remove');
Route::post('/cart/destroy', [CartController::class, 'destroy'])->name('product.cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/product/{slug}', [DetailsController::class, 'index'])->name('product.details');
Route::get('/product-category/{category_slug}', [CategoryController::class, 'index'])->name('product.category');

Route::post('/search', [HeaderSearchController::class, 'index'])->name('product.header_search');
Route::get('/search', [SearchController::class, 'index'])->name('product.search');
