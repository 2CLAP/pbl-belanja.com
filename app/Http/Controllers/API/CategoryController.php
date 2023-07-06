<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function all(Request $request) {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $show_product = $request->input('show_product');

        if($id) {
            $category = Category::with(['products'])->find($id);

            if($category) {
                return ResponseFormatter::success(
                    $category,
                    'Data category berhasil diambil'
                );
            }
            else {
                return ResponseFormatter::error(
                    null,
                    'Data category kosong',
                    404
                );
            }
        }

        $category = Category::query();

        if($name) {
            $category->where('name', 'Like', '%' . $name . '%');
        }

        if ($show_product) {
            $category->with('products');
        }

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data category berhasil diambil'
        );
    }
}


// Route::get('products', [App\Http\Controllers\API\ProductController::class, 'all']);
// Route::get('categories', [App\Http\Controllers\API\CategoryController::class, 'all']);

// Route::post('register', [App\Http\Controllers\API\UserController::class, 'register']);
// Route::post('login', [App\Http\Controllers\API\UserController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function() {
//     Route::get('user', [App\Http\Controllers\API\UserController::class, 'fetch']);
//     Route::post('user', [App\Http\Controllers\API\UserController::class, 'updateProfile']);
//     Route::post('logout', [App\Http\Controllers\API\UserController::class, 'logout']);

//     Route::get('transaction', [App\Http\Controllers\API\TransactionController::class, 'all']);
//     Route::post('checkout', [App\Http\Controllers\API\TransactionController::class, 'checkout']);
// });