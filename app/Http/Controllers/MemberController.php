<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil transaksi milik user yang sedang login saja
        // Menggunakan 'with' untuk eager loading relasi agar lebih efisien
        $transactions = Transaction::with(['item.game', 'payment_method'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Hitung statistik sederhana
        // Hanya menghitung transaksi yang statusnya 'DONE' (Selesai/Sukses)
        $totalSpent = $transactions->where('status', 'DONE')->sum('amount');
        
        // Menghitung total jumlah transaksi
        $totalTransactions = $transactions->count();

        // Mengirim data ke view 'member.dashboard'
        return view('member.dashboard', compact('transactions', 'totalSpent', 'totalTransactions'));
    }
}