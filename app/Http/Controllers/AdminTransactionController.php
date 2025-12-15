<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi terbaru.
     * Menggunakan eager loading (with) untuk mengambil data relasi agar lebih efisien.
     */
    public function index()
    {
        // Ambil transaksi urut dari yang terbaru
        // Relasi 'item.game' berarti mengambil data item sekaligus gamenya
        // Relasi 'payment_method' mengambil data metode pembayaran
        $transactions = Transaction::with(['item.game', 'payment_method'])
            ->latest()
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Memperbarui status transaksi (misal: dari PENDING ke PAID atau DONE).
     */
    public function updateStatus(Request $request, Transaction $transaction)
    {
        // Validasi input status agar sesuai dengan ENUM di database
        $request->validate([
            'status' => 'required|in:PENDING,PAID,DONE,FAILED'
        ]);

        // Update status
        $transaction->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status transaksi berhasil diperbarui!');
    }
}