<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AddCategoryController;
use App\Http\Controllers\Admin\EditCategoryController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AddProductController;
use App\Http\Controllers\Admin\EditProductController;

use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\AddHomeSliderController;
use App\Http\Controllers\Admin\EditHomeSliderController;

use App\Http\Controllers\Admin\HomeCategoryController;

use App\Http\Controllers\Admin\OnSaleController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\UsersController;

Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('admin/stats', [StatsController::class, 'index']);

    $subject = 'categories';
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.' . $subject);
    Route::get('/admin/categories/add', [AddCategoryController::class, 'index'])->name('admin.add' . $subject);
    Route::post('/admin/categories/add', [AddCategoryController::class, 'store']);
    Route::get('/admin/categories/edit/{slug}', [EditCategoryController::class, 'index'])->name('admin.edit' . $subject);
    Route::patch('/admin/categories/edit', [EditCategoryController::class, 'update']);
    Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'delete']);
    // Products Routes
    $subject = 'products';
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.' . $subject);
    Route::get('/admin/products/add', [AddProductController::class, 'index'])->name('admin.add' . $subject);
    Route::post('/admin/products/add', [AddProductController::class, 'store']);
    Route::get('/admin/products/add-from-json', [AddProductController::class, 'renderCreateProductFromJson']);
    Route::post('/admin/products/add-from-json', [AddProductController::class, 'createProductFromJson']);
    Route::get('/admin/products/edit/{slug}', [EditProductController::class, 'index'])->name('admin.edit' . $subject);
    Route::post('/admin/products/edit', [EditProductController::class, 'update']);
    Route::delete('/admin/products/delete/{id}', [ProductController::class, 'delete']);

    // Products Routes
    $subject = 'orders';
    Route::get('/admin/orders', [OrdersController::class, 'index'])->name('admin.' . $subject);
    Route::get('/admin/orders/update-status/{id}', [OrdersController::class, 'updateStatus'])->name('admin.' . $subject.'.update-status');
    
    // Products Routes
    $subject = 'users';
    Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.' . $subject);

    // HomeSlider Routes
    $subject = 'home-sliders';
    Route::get('/admin/' . $subject, [HomeSliderController::class, 'index'])->name('admin.' . $subject);
    Route::get('/admin/' . $subject . '/add', [AddHomeSliderController::class, 'index'])->name('admin.' . $subject . '.add');
    Route::post('/admin/' . $subject . '/add', [AddHomeSliderController::class, 'store'])->name('admin.' . $subject . '.store');
    Route::get('/admin/' . $subject . '/edit/{id}', [EditHomeSliderController::class, 'index'])->name('admin.' . $subject . '.edit');
    Route::patch('/admin/' . $subject . '/edit/', [EditHomeSliderController::class, 'update'])->name('admin.' . $subject . '.update');
    Route::delete('/admin/' . $subject . '/delete/{id}', [HomeSliderController::class, 'delete'])->name('admin.' . $subject . '.delete');

    // HomeCategories Routes
    $subject = 'home-categories';
    Route::get('/admin/' . $subject, [HomeCategoryController::class, 'index'])->name('admin.' . $subject);
    Route::post('/admin/' . $subject, [HomeCategoryController::class, 'store'])->name('admin.' . $subject . '.store');

    $subject = 'on-sale';
    Route::get('/admin/' . $subject, [OnSaleController::class, 'index'])->name('admin.' . $subject);
    Route::post('/admin/' . $subject, [OnSaleController::class, 'store'])->name('admin.' . $subject . '.store');

    $subject = 'reports';
    Route::get('/admin/' . $subject, [ReportController::class, 'index'])->name('admin.' . $subject);
    Route::post('/admin/' . $subject, [OnSaleController::class, 'store'])->name('admin.' . $subject . '.store');
});
