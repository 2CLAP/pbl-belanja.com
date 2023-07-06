<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\Admin\TagRequest;

use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Tag::query();

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
                                    <a class="dropdown-item" href="'. route('tag.edit', $item->id) .'">
                                        Sunting
                                    </a>
                                    <form action="'. route('tag.destroy', $item->id) .'" method="POST">
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
                ->editColumn('discount_price', function($item) {
                    return $item->discount_price ? $item->discount_price : '-';
                })
                ->rawColumns(['action','discount_price'])
                ->make();
        }

        return view('pages.admin.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $data = $request->all();

        // $data['slug'] = Str::slug($request->name);
        // $data['photo'] = $request->file('photo')->store('assets/category','public');
        
        Tag::create($data);

        return redirect()->route('tag.index');
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
        $item = Tag::findOrFail($id);

        return view('pages.admin.tag.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, string $id)
    {
        $data = $request->all();

        // $data['slug'] = Str::slug($request->name);
        // $data['photo'] = $request->file('photo')->store('assets/category','public');
        
        $item = Tag::findOrFail($id);

        $item->update($data);

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Tag::findOrFail($id);
        $item->delete();

        return redirect()->route('tag.index');
    }
}
