<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Product::with(['category']);

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1"
                                type="button"
                                data-toggle="dropdown"
                                >
                                Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'. route('product.edit', $item->id) .'">
                                        Sunting
                                    </a>
                                    <form action="'. route('product.destroy', $item->id) .'" method="POST">
                                        '. method_field('delete') . csrf_field() .'
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                // ->addColumn('discount_price', function($item) {
                //     $discountPrice = Product::where('tags_id', $item->id)->first();
                //     return $discountPrice->discount_price ? $discountPrice->discount_price : '-';
                // })
                ->editColumn('tag', function($item) {
                    return $item->tags_id ? $item->tag->name : '-';
                })
                ->rawColumns(['action','tag'])
                ->make();
        }

        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('pages.admin.product.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        // dd($data);

        $data['slug'] = Str::slug($request->name);

        // Logika untuk mengatur nilai 'tags_id' dan 'discount_price'
        if ($request->tags_id) {
            $tags = Tag::find($request->tags_id);
            if ($tags) {
                $data['tags_id'] = $tags->id;
                $data['discount_price'] = $tags->discount_price;
            }
        } else {
            $data['tags_id'] = null; // Atur ke null jika tidak ada tag terkait
            $data['discount_price'] = null; // Atur ke null jika tidak ada tag terkait
        }
        
        Product::create($data);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Product::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('pages.admin.product.edit', [
            'item' => $item,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);
        
        $data['slug'] = Str::slug($request->name);

        // Tambahkan logika untuk mengelola nilai 'tags_id' dan 'discount_price'
        // Logika untuk mengatur nilai 'tags_id' dan 'discount_price'
        if ($request->tags_id) {
            $tags = Tag::find($request->tags_id);
            if ($tags) {
                $data['tags_id'] = $tags->id;
                $data['discount_price'] = $tags->discount_price;
            }
        } else {
            $data['tags_id'] = null;
            $data['discount_price'] = null; 
        }

        $item->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->route('product.index');
    }
}
