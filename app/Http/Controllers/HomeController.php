<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(3)->get(); // Mengambil data categories dari model untuk ditampilkan pada view home. Hanya mengambil 3 categories awal
        $products = Product::with(['galleries'])->take(8)->latest()->get(); // Mengambil data products dari model untuk ditampilkan pada view home. Hanya mengambil 8 products paling baru
        return view('pages.home', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
