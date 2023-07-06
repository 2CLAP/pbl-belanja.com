<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries','category'])->where('slug', $id)->firstOrFail();
        $relatedProduct = Product::with(['galleries'])->where('categories_id', $product->category->id)->where('id', '!=', $product->id)->paginate(4);

        return view('pages.detail', [
            'product' => $product,
            'relatedProduct' => $relatedProduct,
        ]);
    }

    public function add(Request $request, $id) {
        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
