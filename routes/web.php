<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

require 'shop.php';

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

//For User or Customer
Route::middleware(['auth:sanctum', 'verified'])->group(function (){
 Route::get('/user/dashboard',[App\Http\Controllers\User\UserController::class, 'index'])->name('user.dashboard');
});
//For Admin
include "admin.php";

Route::get('/test', function() {
    return view('test');
});


Route::get('/test-post', [App\Http\Controllers\TestController::class, 'index']);
