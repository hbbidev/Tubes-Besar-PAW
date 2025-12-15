@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
<div class="container mx-auto max-w-6xl">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white">Halo, {{ Auth::user()->name }} 👋</h1>
            <p class="text-gray-400 text-sm mt-1">Selamat datang kembali di dashboard member.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('home') }}" class="bg-slate-800 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl border border-slate-700 transition flex items-center">
                <i class="fas fa-plus-circle mr-2 text-blue-500"></i> Topup Baru
            </a>
        </div>
    </div>

    <!-- Statistik User -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <!-- Total Pengeluaran -->
        <div class="glass-panel p-6 rounded-2xl border border-slate-700/50 relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i class="fas fa-wallet text-6xl text-blue-500"></i>
            </div>
            <h3 class="text-gray-400 text-sm font-medium">Total Pengeluaran</h3>
            <p class="text-3xl font-bold text-white mt-2">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
            <div class="mt-4 text-xs text-blue-400 bg-blue-500/10 inline-block px-2 py-1 rounded">
                <i class="fas fa-check-circle mr-1"></i> Transaksi Sukses
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="glass-panel p-6 rounded-2xl border border-slate-700/50 relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i class="fas fa-shopping-bag text-6xl text-purple-500"></i>
            </div>
            <h3 class="text-gray-400 text-sm font-medium">Total Transaksi</h3>
            <p class="text-3xl font-bold text-white mt-2">{{ $totalTransactions }}</p>
            <div class="mt-4 text-xs text-purple-400 bg-purple-500/10 inline-block px-2 py-1 rounded">
                Semua Riwayat
            </div>
        </div>

        <!-- Status Akun -->
        <div class="glass-panel p-6 rounded-2xl border border-slate-700/50 relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i class="fas fa-user-shield text-6xl text-green-500"></i>
            </div>
            <h3 class="text-gray-400 text-sm font-medium">Status Akun</h3>
            <p class="text-xl font-bold text-green-400 mt-2 uppercase">{{ Auth::user()->role }}</p>
            <div class="mt-5 text-xs text-gray-500">
                Member sejak {{ Auth::user()->created_at->format('d M Y') }}
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div class="glass-panel p-6 rounded-xl border border-slate-700/50">
        <h2 class="text-xl font-bold mb-6 flex items-center">
            <i class="fas fa-history mr-2 text-blue-500"></i> Riwayat Pembelian
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-800/50 text-gray-400 uppercase text-xs">
                    <tr>
                        <th class="p-4 rounded-tl-lg">Game Info</th>
                        <th class="p-4">Item</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 rounded-tr-lg">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-slate-800/30 transition">
                        <td class="p-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $trx->item->game->thumbnail ?? 'https://placehold.co/50' }}" class="w-10 h-10 rounded-lg object-cover" alt="icon">
                                <div>
                                    <div class="font-bold text-white">{{ $trx->item->game->name ?? '-' }}</div>
                                    <div class="text-xs text-gray-500 font-mono">{{ $trx->invoice }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="text-white">{{ $trx->item->name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $trx->target_id }}</div>
                        </td>
                        <td class="p-4 font-bold text-green-400">
                            Rp {{ number_format($trx->amount, 0, ',', '.') }}
                        </td>
                        <td class="p-4">
                            @if($trx->status == 'PENDING')
                                <span class="bg-yellow-500/10 text-yellow-500 px-3 py-1 rounded-full text-xs font-bold border border-yellow-500/20">Menunggu</span>
                            @elseif($trx->status == 'PAID')
                                <span class="bg-blue-500/10 text-blue-500 px-3 py-1 rounded-full text-xs font-bold border border-blue-500/20">Dibayar</span>
                            @elseif($trx->status == 'DONE')
                                <span class="bg-green-500/10 text-green-500 px-3 py-1 rounded-full text-xs font-bold border border-green-500/20">Sukses</span>
                            @else
                                <span class="bg-red-500/10 text-red-500 px-3 py-1 rounded-full text-xs font-bold border border-red-500/20">Gagal</span>
                            @endif
                        </td>
                        <td class="p-4 text-gray-400 text-xs">
                            {{ $trx->created_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center p-8 text-gray-500">
                            <i class="fas fa-receipt text-4xl mb-3 opacity-20 block"></i>
                            Belum ada riwayat transaksi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection