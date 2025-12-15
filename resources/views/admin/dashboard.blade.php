@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>
    
    <!-- Statistik Sederhana -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="glass-panel p-6 rounded-xl border-l border-blue-500">
            <h3 class="text-gray-400 text-sm">Total Transaksi</h3>
            <p class="text-4xl font-bold text-white mt-2">{{ \App\Models\Transaction::count() }}</p>
        </div>
        <div class="glass-panel p-6 rounded-xl border-l border-green-500">
            <h3 class="text-gray-400 text-sm">Pendapatan (Sukses)</h3>
            <p class="text-4xl font-bold text-white mt-2">
                Rp {{ number_format(\App\Models\Transaction::where('status', 'DONE')->sum('amount') / 1000000, 1) }}Jt
            </p>
        </div>
        <div class="glass-panel p-6 rounded-xl border-l border-purple-500">
            <h3 class="text-gray-400 text-sm">Game Terdaftar</h3>
            <p class="text-4xl font-bold text-white mt-2">{{ \App\Models\Game::count() }}</p>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <div class="glass-panel p-8 rounded-xl">
        <h2 class="text-xl font-bold mb-6">Akses Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            
            <a href="{{ route('games.index') }}" class="group block p-6 bg-violet-300/10 border border-slate-700 rounded-xl hover:bg-violet-300/30 hover:border-blue-500 transition">
                <div class="flex items-center justify-between mb-4">
                    <i class="fas fa-gamepad text-3xl text-blue-500 group-hover:scale-110 transition"></i>
                    <span class="text-xs text-gray-500 group-hover:text-blue-400">Manage</span>
                </div>
                <h3 class="text-lg font-bold">Kelola Game & Item</h3>
                <p class="text-sm text-gray-400 mt-2">Tambah game baru, edit info, dan atur harga nominal topup.</p>
            </a>

            <a href="{{ route('transactions.index') }}" class="group block p-6 bg-violet-300/10 border border-slate-700 rounded-xl hover:bg-violet-300/30 hover:border-green-500 transition">
                <div class="flex items-center justify-between mb-4">
                    <i class="fas fa-receipt text-3xl text-green-500 group-hover:scale-110 transition"></i>
                    <span class="text-xs text-gray-500 group-hover:text-green-400">Manage</span>
                </div>
                <h3 class="text-lg font-bold">Kelola Transaksi</h3>
                <p class="text-sm text-gray-400 mt-2">Pantau transaksi masuk dan update status pembayaran secara manual.</p>
            </a>

            <div class="group block p-6 bg-violet-300/10 border border-slate-700 rounded-xl hover:bg-violet-300/30 rounded-xl opacity-50 cursor-not-allowed">
                <div class="flex items-center justify-between mb-4">
                    <i class="fas fa-cog text-3xl text-purple-500"></i>
                    <span class="text-xs text-gray-500">Soon</span>
                </div>
                <h3 class="text-lg font-bold">Pengaturan Website</h3>
                <p class="text-sm text-gray-400 mt-2">Fitur pengaturan umum website (Segera Hadir).</p>
            </div>

        </div>
    </div>
</div>
@endsection