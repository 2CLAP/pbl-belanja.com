<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('register/check', [App\Http\Controllers\Auth\RegisterController::class, 'check'])->name('api-register-check');
Route::get('provinces', [App\Http\Controllers\API\LocationController::class, 'provinces'])->name('api-provinces');
Route::get('regencies/{provinces_id}', [App\Http\Controllers\API\LocationController::class, 'regencies'])->name('api-regencies');


Route::get('products', [App\Http\Controllers\API\ProductController::class, 'all']);
Route::get('categories', [App\Http\Controllers\API\CategoryController::class, 'all']);

Route::post('register', [App\Http\Controllers\API\UserController::class, 'register']);
Route::post('login', [App\Http\Controllers\API\UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('user', [App\Http\Controllers\API\UserController::class, 'fetch']);
    Route::post('user', [App\Http\Controllers\API\UserController::class, 'updateProfile']);
    Route::post('logout', [App\Http\Controllers\API\UserController::class, 'logout']);

    Route::get('transaction', [App\Http\Controllers\API\TransactionController::class, 'all']);
    Route::post('checkout', [App\Http\Controllers\API\TransactionController::class, 'checkout']);
});