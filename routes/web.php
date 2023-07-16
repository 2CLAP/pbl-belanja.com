<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\CategoryController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('details');
Route::post('/details/{id}', [App\Http\Controllers\DetailController::class, 'add'])->name('detail-add');

Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');

    Route::get('/account', [\App\Http\Controllers\AccountController::class, 'index'])->name('account');
    Route::post('/account/{redirect}', [\App\Http\Controllers\AccountController::class, 'update'])->name('account-redirect');
    
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');

    Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transactions');
    Route::get('/transactions/{id}', [\App\Http\Controllers\TransactionController::class, 'details'])->name('transaction-details');
    Route::post('/transactions/{id}', [\App\Http\Controllers\TransactionController::class, 'update'])->name('transaction-update');
    
    // Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success');
    Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');
});

Route::prefix('admin')
    ->middleware(['auth','admin']) // Comment atau non-aktifkan query ini agar bisa mengakses pembuatan akun admin
    ->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('product-gallery', \App\Http\Controllers\Admin\ProductGalleryController::class);
        Route::resource('transaction', \App\Http\Controllers\Admin\TransactionController::class);
        Route::resource('tag', \App\Http\Controllers\Admin\TagController::class);
    });

Auth::routes();

