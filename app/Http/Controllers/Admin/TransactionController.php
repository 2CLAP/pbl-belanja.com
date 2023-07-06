<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Transaction::with(['user']);

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
                                    <a class="dropdown-item" href="'. route('transaction.edit', $item->id) .'">
                                        Sunting
                                    </a>
                                    <form action="'. route('transaction.destroy', $item->id) .'" method="POST">
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
                ->addColumn('shipping_status', function ($item) {
                    $transactionDetail = TransactionDetail::where('transactions_id', $item->id)->first();
                    return $transactionDetail ? $transactionDetail->shipping_status : '-'; // Menambahkan kolom "shipping_status" menggunakan metode addColumn(). Dan juga menggunakan model TransactionDetail untuk mengambil data terkait status pengiriman (shipping_status) berdasarkan transactions_id. Jika tidak ada detail transaksi yang terkait, maka akan ditampilkan tanda "-" sebagai tanda bahwa tidak ada status pengiriman yang tersedia.
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.admin.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $item = Transaction::findOrFail($id);
        $ship = TransactionDetail::where('transactions_id', $id)->first();

        return view('pages.admin.transaction.edit', [
            'item' => $item,
            'ship' => $ship,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $item = Transaction::findOrFail($id);
        $ship = TransactionDetail::where('transactions_id', $id)->get();

        $item->update($data);
        $ship->each(function ($detail) use ($data) { // Menggunakan use ($data) pada fungsi closure untuk memberikan akses ke variabel $data di dalam closure.
            $detail->update($data);
        });
        // $ship->update($data);

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Transaction::findOrFail($id);
        $ship = TransactionDetail::where('transactions_id', $id)->get();

        $item->delete();
        $ship->each(function ($detail) { // $detail mewakili objek TransactionDetail individual dalam koleksi. Dalam kasus ini, kita memanggil metode delete() pada setiap objek $detail untuk menghapus entitas TransactionDetail dari database.
            $detail->delete();
        });
        // $ship->delete();

        return redirect()->route('transaction.index');
    }
}
