@extends('layouts.app')

@section('title', 'Topup ' . $game->name)

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri: Info Game -->
        <div class="lg:col-span-1">
            <div class="glass-panel rounded-xl p-6 sticky top-24">
                <img src="{{ $game->thumbnail ?? '[https://placehold.co/600x400/1e293b/FFF?text='.urlencode($game-](https://placehold.co/600x400/1e293b/FFF?text='.urlencode($game-)>name) }}" alt="{{ $game->name }}" class="w-32 h-32 rounded-xl shadow-lg mb-4 mx-auto lg:mx-0 object-cover">
                <h2 class="text-2xl font-bold mb-2 text-center lg:text-left">{{ $game->name }}</h2>
                <div class="border-t border-slate-700 pt-4 mt-4">
                    <h3 class="font-semibold mb-2">Cara Topup:</h3>
                    <ol class="list-decimal list-inside text-sm text-gray-400 space-y-1">
                        <li>Masukkan User ID</li>
                        <li>Pilih Nominal</li>
                        <li>Pilih Pembayaran</li>
                        <li>Klik Beli Sekarang</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('order.process') }}" method="POST" id="orderForm">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}">
                
                <!-- 1. Input ID -->
                <div class="glass-panel rounded-xl p-6 mb-6">
                    <h3 class="text-xl font-bold mb-4">1. Masukkan Data Akun</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="target_id" required placeholder="User ID" class="bg-slate-800 border border-slate-600 rounded-lg p-3 w-full text-white">
                        <input type="text" name="server_id" placeholder="Server ID (Optional)" class="bg-slate-800 border border-slate-600 rounded-lg p-3 w-full text-white">
                    </div>
                </div>

                <!-- 2. Pilih Item -->
                <div class="glass-panel rounded-xl p-6 mb-6">
                    <h3 class="text-xl font-bold mb-4">2. Pilih Nominal</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($game->items as $item)
                            <label class="cursor-pointer">
                                <input type="radio" name="item_id" value="{{ $item->id }}" class="peer sr-only" onchange="updateTotal({{ $item->price }})">
                                <div class="bg-slate-800 border border-slate-600 rounded-lg p-4 peer-checked:border-blue-500 peer-checked:bg-blue-900/20 hover:bg-slate-700 transition">
                                    <p class="font-bold text-white">{{ $item->name }}</p>
                                    <p class="text-blue-400 text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- 3. Pilih Pembayaran -->
                <div class="glass-panel rounded-xl p-6 mb-6">
                    <h3 class="text-xl font-bold mb-4">3. Pilih Pembayaran</h3>
                    <div class="space-y-3">
                        @foreach($payments as $payment)
                            <label class="cursor-pointer block">
                                <input type="radio" name="payment_method_id" value="{{ $payment->id }}" class="peer sr-only">
                                <div class="bg-slate-800 border border-slate-600 rounded-lg p-4 flex items-center justify-between peer-checked:border-blue-500 peer-checked:bg-blue-900/20 hover:bg-slate-700">
                                    <span class="font-bold">{{ $payment->name }}</span>
                                    <span class="text-xs text-gray-400">Biaya Admin: Rp {{ number_format($payment->admin_fee, 0, ',', '.') }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Tombol Beli -->
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:scale-[1.02]">
                    Beli Sekarang <span id="total-display"></span>
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function updateTotal(price) {
        document.getElementById('total-display').innerText = '- Rp ' + new Intl.NumberFormat('id-ID').format(price);
    }
</script>
@endpush
