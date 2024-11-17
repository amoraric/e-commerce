<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [ShoppingCartController::class, 'index']);
    Route::post('/cart/add', [ShoppingCartController::class, 'addToCart']);
    Route::post('/cart/checkout', [ShoppingCartController::class, 'checkout']);
    Route::post('/apply-discount', [DiscountController::class, 'applyDiscount']);
    Route::get('/user/profile', [UserController::class, 'show']);
    Route::post('/user/update', [UserController::class, 'update']);
});

Route::get('/products', [ProductController::class, 'index']);