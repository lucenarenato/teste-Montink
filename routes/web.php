<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\WebhookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/products/{product}/buy', [ProductController::class, 'addToCart'])->name('products.buy');

Route::get('/products/add', function () {
    return view('products/create');
});

Route::prefix('coupons')->name('coupons.')->group(function () {
    Route::get('/', [CouponController::class, 'index'])->name('index');
    Route::get('/create', [CouponController::class, 'create'])->name('create');
    Route::post('/', [CouponController::class, 'store'])->name('store');
    Route::get('/{coupon}', [CouponController::class, 'show'])->name('show');
    Route::get('/{coupon}/edit', [CouponController::class, 'edit'])->name('edit');
    Route::put('/{coupon}', [CouponController::class, 'update'])->name('update');
    Route::delete('/{coupon}', [CouponController::class, 'destroy'])->name('destroy');
});

// Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
// Route::get('/checkout', [OrderController::class, 'checkoutForm'])->name('orders.checkout.form');
// Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');

Route::get('/cep/check', [CepController::class, 'check'])->name('cep.check');
Route::get('/check-cep', [CepController::class, 'checkCep'])->name('check.cep');

Route::post('/webhook/order-status', [WebhookController::class, 'orderStatus']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


