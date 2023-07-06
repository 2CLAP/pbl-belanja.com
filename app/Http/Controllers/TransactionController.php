<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class TransactionController extends Controller
{
    public function index(){

        $onProcessTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function ($transaction) { // Metode whereHas untuk mencocokkan relasi transaction dengan kondisi yang tepat atau lebih gampangnya memfilter
                $transaction->where('users_id', Auth::user()->id) // Menggunakan kondisi where dengan transaksi yang sudah dilakukan oleh ID pengguna yang sudah terotentikasi
                            ->whereIn('shipping_status', ['PENDING', 'SHIPPING']); // Metode whereIn untuk mencocokkan nilai kolom shipping_status dengan array ['PENDING', 'SHIPPING'] pada transaksi yang sedang diproses
            })
            ->get();

        $successTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function ($transaction) {
                $transaction->where('users_id', Auth::user()->id) 
                            ->where('shipping_status', 'SUCCESS'); // Menggunakan kondisi where dengan transaksi yang sudah dilakukan dengan nilai 'SUCCESS' pada kolom shipping_status
            })
            ->get();

        return view('pages.transaction', [
            'onProcessTransactions' => $onProcessTransactions,
            'successTransactions' => $successTransactions
        ]);
    }

    public function details(Request $request, $id) {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])->findOrFail($id);
        return view('pages.transaction-details', [
            'transaction' => $transaction
        ]);
    }
    
}