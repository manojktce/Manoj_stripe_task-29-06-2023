<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\StripePaymentController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'is_admin'], function () {
	Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

	Route::get('products', [ProductController::class, 'index'])->name('products');
	Route::resource('/admin/products',ProductController::class);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('/home/product_show/{id}', [HomeController::class, 'product_show'])->name('product_show');

	Route::get('/home/my_orders', [HomeController::class, 'my_orders'])->name('my_orders');

	Route::get('stripe', [StripePaymentController::class, 'stripe'])->name('stripe');
	Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

});