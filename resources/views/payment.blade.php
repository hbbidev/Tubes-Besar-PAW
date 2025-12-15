@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<!-- LOGIC URL DINAMIS -->
@php
    $isProduction = config('midtrans.is_production');
    $snapJsUrl = $isProduction 
        ? 'https://app.midtrans.com/snap/snap.js' 
        : 'https://app.sandbox.midtrans.com/snap/snap.js';
@endphp

<!-- Load Snap JS sesuai Environment -->
<script type="text/javascript"
    src="{{ $snapJsUrl }}"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<div class="container mx-auto max-w-md py-12">
    <div class="glass-panel p-8 rounded-xl text-center border border-slate-700 shadow-2xl relative overflow-hidden">
        
        <!-- Header Icon -->
        <div class="mb-6 relative z-10">
            <div class="absolute inset-0 bg-blue-500 blur-2xl opacity-20 rounded-full"></div>
            <i class="fas fa-file-invoice-dollar text-6xl text-blue-500 animate-pulse relative z-10"></i>
        </div>
        
        <h2 class="text-2xl font-bold text-white mb-2">Konfirmasi Pembayaran</h2>
        
        <!-- Tampilkan Mode untuk Debugging -->
        <p class="text-gray-400 text-sm mb-6 mt-2">ID Transaksi: <span class="font-mono text-blue-400 font-bold bg-blue-500/10 px-2 py-1 rounded">{{ $transaction->invoice }}</span></p>

        <!-- Detail Transaksi Box -->
        <div class="bg-slate-800/80 p-5 rounded-xl text-left mb-8 border border-slate-700/50 backdrop-blur-sm">
            <div class="flex justify-between mb-3 text-sm border-b border-slate-700 pb-3">
                <span class="text-gray-400">Game</span>
                <span class="text-white font-bold text-right">{{ $transaction->item->game->name }}</span>
            </div>
            <div class="flex justify-between mb-3 text-sm border-b border-slate-700 pb-3">
                <span class="text-gray-400">Item</span>
                <span class="text-white text-right">{{ $transaction->item->name }}</span>
            </div>
            <div class="flex justify-between mb-3 text-sm">
                <span class="text-gray-400">User ID</span>
                <span class="text-white text-right">{{ $transaction->target_id }}</span>
            </div>
            <div class="flex justify-between pt-3 border-t-2 border-dashed border-slate-600 mt-4">
                <span class="text-gray-300 font-bold">Total Bayar</span>
                <span class="text-green-400 font-bold text-xl">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Tombol Bayar -->
        <button id="pay-button" class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-blue-500/30 transform hover:scale-[1.02] flex items-center justify-center group">
            <i class="fas fa-wallet mr-2 group-hover:rotate-12 transition"></i> Bayar Sekarang
        </button>
        
        <!-- Tombol Kembali -->
        <a href="{{ route('member.dashboard') }}" class="block mt-6 text-sm text-gray-500 hover:text-white transition flex items-center justify-center">
            <i class="fas fa-arrow-left mr-2"></i> Bayar Nanti (Ke Dashboard)
        </a>
    </div>
</div>

<script type="text/javascript">
    const payButton = document.getElementById('pay-button');
    
    payButton.addEventListener('click', function () {
        const snapToken = '{{ $transaction->snap_token }}';
        
        if(!snapToken){
            alert("Error: Snap Token tidak ditemukan. Silakan buat transaksi baru.");
            return;
        }

        window.snap.pay(snapToken, {
            onSuccess: function(result){
                alert("Pembayaran Berhasil!");
                window.location.href = "{{ route('member.dashboard') }}";
            },
            onPending: function(result){
                alert("Menunggu pembayaran! Silakan selesaikan di aplikasi pembayaran Anda.");
                window.location.href = "{{ route('member.dashboard') }}";
            },
            onError: function(result){
                console.log(result);
                alert("Pembayaran gagal!");
                window.location.href = "{{ route('member.dashboard') }}";
            },
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });
</script>
@endsection