<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::with(['galleries','tag'])->paginate(8);

        return view('pages.category', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail(Request $request, $id)
    {
        $categories = Category::all();
        $category = Category::where('slug', $id)->firstOrFail();
        $products = Product::with(['galleries','tag'])->where('categories_id', $category->id)->paginate(8);

        return view('pages.category', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
