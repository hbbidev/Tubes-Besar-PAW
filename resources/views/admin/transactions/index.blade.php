@extends('layouts.app')

@section('title', 'Kelola Transaksi')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">Daftar Transaksi</h1>

    @if(session('success'))
        <div class="bg-green-500/20 border border-green-500/50 text-green-400 p-3 rounded mb-4 flex items-center">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="glass-panel p-6 rounded-xl overflow-x-auto shadow-xl">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-700 text-gray-400 uppercase font-semibold">
                <tr>
                    <th class="p-4">Invoice</th>
                    <th class="p-4">Game & User</th>
                    <th class="p-4">Item & Payment</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status Saat Ini</th>
                    <th class="p-4">Update Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($transactions as $trx)
                <tr class="hover:bg-slate-800/50 transition duration-200">
                    <td class="p-4 align-top">
                        <span class="font-mono text-blue-400 font-bold block">{{ $trx->invoice }}</span>
                        <span class="text-xs text-gray-500 block mt-1">
                            <i class="far fa-clock mr-1"></i> {{ $trx->created_at->format('d M Y H:i') }}
                        </span>
                    </td>
                    <td class="p-4 align-top">
                        <div class="font-bold text-white text-base">{{ $trx->item->game->name ?? 'Game Terhapus' }}</div>
                        <div class="text-xs text-gray-400 mt-1">
                            <span class="bg-slate-700 px-1.5 py-0.5 rounded text-gray-300">ID</span> {{ $trx->target_id }}
                        </div>
                        @if($trx->server_id)
                        <div class="text-xs text-gray-400 mt-0.5">
                            <span class="bg-slate-700 px-1.5 py-0.5 rounded text-gray-300">Server</span> {{ $trx->server_id }}
                        </div>
                        @endif
                    </td>
                    <td class="p-4 align-top">
                        <div class="text-white font-medium">{{ $trx->item->name ?? 'Item Terhapus' }}</div>
                        <div class="text-xs text-gray-500 mt-1 flex items-center">
                            <i class="fas fa-wallet mr-1.5"></i> {{ $trx->payment_method->name ?? 'Unknown' }}
                        </div>
                    </td>
                    <td class="p-4 align-top">
                        <span class="font-bold text-lg text-green-400">
                            Rp {{ number_format($trx->amount, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="p-4 align-top">
                        @if($trx->status == 'PENDING')
                            <span class="inline-flex items-center bg-yellow-500/10 text-yellow-500 border border-yellow-500/50 px-3 py-1 rounded-full text-xs font-bold">
                                <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2 animate-pulse"></span> Pending
                            </span>
                        @elseif($trx->status == 'PAID')
                            <span class="inline-flex items-center bg-blue-500/10 text-blue-500 border border-blue-500/50 px-3 py-1 rounded-full text-xs font-bold">
                                <i class="fas fa-money-bill-wave mr-1.5"></i> Paid
                            </span>
                        @elseif($trx->status == 'DONE')
                            <span class="inline-flex items-center bg-green-500/10 text-green-500 border border-green-500/50 px-3 py-1 rounded-full text-xs font-bold">
                                <i class="fas fa-check mr-1.5"></i> Success
                            </span>
                        @else
                            <span class="inline-flex items-center bg-red-500/10 text-red-500 border border-red-500/50 px-3 py-1 rounded-full text-xs font-bold">
                                <i class="fas fa-times mr-1.5"></i> Failed
                            </span>
                        @endif
                    </td>
                    <td class="p-4 align-top">
                        <form action="{{ route('transactions.update', $trx->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf @method('PUT')
                            <div class="relative">
                                <select name="status" class="appearance-none bg-slate-900 border border-slate-600 rounded-lg text-xs py-2 pl-3 pr-8 text-white focus:border-blue-500 outline-none cursor-pointer hover:border-slate-500 transition">
                                    <option value="PENDING" {{ $trx->status == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                    <option value="PAID" {{ $trx->status == 'PAID' ? 'selected' : '' }}>Paid</option>
                                    <option value="DONE" {{ $trx->status == 'DONE' ? 'selected' : '' }}>Done (Sukses)</option>
                                    <option value="FAILED" {{ $trx->status == 'FAILED' ? 'selected' : '' }}>Failed</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white p-2 rounded-lg transition shadow-lg" title="Simpan Perubahan">
                                <i class="fas fa-save"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-12">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <i class="fas fa-receipt text-6xl mb-4 opacity-20"></i>
                            <p class="text-lg font-medium">Belum ada transaksi</p>
                            <p class="text-sm">Transaksi yang masuk akan muncul di sini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection