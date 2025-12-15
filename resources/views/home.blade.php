@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="space-y-12 pb-12">
    
    <!-- Hero Section & Search -->
    <div class="text-center py-16 px-4 relative overflow-hidden">
        <!-- Efek Glow Background -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-violet-600/20 blur-[120px] rounded-full -z-10 pointer-events-none"></div>

        <h1 class="text-4xl md:text-6xl font-bold mb-4 tracking-tight">
            Topup Game <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Tercepat</span>
        </h1>
        <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
            Layanan topup game otomatis 24 jam. Proses hitungan detik, harga bersahabat, dan 100% legal.
        </p>

        <!-- Search Bar Besar -->
        <form action="{{ route('home') }}" method="GET" class="max-w-xl mx-auto relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl blur opacity-25 group-hover:opacity-50 transition duration-200"></div>
                    <div class="relative flex items-center bg-black/30 rounded-xl border border-slate-700 p-2 shadow-2xl">
                        <i class="fas fa-search text-gray-400 ml-3"></i>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search" 
                               class="w-full bg-transparent text-white px-4 py-2 focus:outline-none placeholder-gray-500"
                               autocomplete="off">
                        <button type="submit" class="bg-violet-600 hover:bg-violet-500 text-white px-6 py-2 rounded-lg font-bold transition">
                            Cari
                        </button>
                    </div>
                </form>
    </div>

    <!-- Promo Banner (Optional Slider Style) -->
    <div class="relative w-full rounded-2xl overflow-hidden shadow-2xl border border-slate-800 group">
         <img src="{{ asset('banner.png') }}" alt="Banner" class="w-full h-48 md:h-72 object-cover opacity-80 group-hover:opacity-100 transition duration-700 transform group-hover:scale-105">
         <div class="absolute inset-0 bg-gradient-to-t from-violet-900/30 to-transparent"></div>
         <!-- <div class="absolute bottom-0 left-0 p-6 md:p-10">
             <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full mb-2 inline-block shadow-lg">HOT PROMO</span>
             <h3 class="text-2xl md:text-3xl font-bold text-white mb-1">Diskon Spesial Akhir Pekan</h3>
             <p class="text-gray-300 text-sm md:text-base">Dapatkan bonus item eksklusif untuk setiap pembelian di atas 100rb.</p>
         </div> -->
    </div>

    <!-- Game List Section -->
    <div id="games-section">
        <div class="flex items-center justify-between mb-6 px-2">
            <h2 class="text-2xl font-bold flex items-center text-white">
                <span class="bg-violet-600 w-1 h-8 rounded-full mr-3"></span>
                Game Populer
            </h2>
            <a href="#" class="text-sm text-violet-400 hover:text-violet-300 transition">Lihat Semua <i class="fas fa-chevron-right ml-1 text-xs"></i></a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @foreach($games as $game)
                <a href="{{ route('order.show', $game->slug) }}" class="group relative block h-full">
                    <div class=" rounded-xl overflow-hidden border border-slate-700/50 hover:border-violet-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-violet-500/10 transform hover:-translate-y-1 h-full flex flex-col">
                        <div class="relative w-full aspect-[3/4] overflow-hidden bg-slate-900">
                            <img src="{{ $game->thumbnail ?? 'https://placehold.co/300x400/1e293b/FFF?text='.urlencode($game->name) }}" 
                                 alt="{{ $game->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500 ease-out"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-60"></div>
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center backdrop-blur-[2px]">
                                <span class="bg-violet-600 text-white px-6 py-2 rounded-full text-xs font-bold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                                    Topup
                                </span>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-4 text-center flex-grow flex flex-col justify-center relative bg-violet-800/20">
                            <!-- Garis dekorasi atas -->
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-10 h-1 bg-violet-500 rounded-b-full opacity-0 group-hover:opacity-100 transition duration-300"></div>
                            
                            <h3 class="font-bold text-white text-sm md:text-base leading-tight group-hover:text-violet-400 transition line-clamp-2 mb-1">
                                {{ $game->name }}
                            </h3>
                            <p class="text-[11px] text-gray-500 uppercase tracking-wider font-semibold group-hover:text-gray-400 transition">KidPedia
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Features / Keunggulan (Bottom) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-8 border-t border-slate-800">
        <div class="flex items-center p-5 bg-gradient-to-r from-violet-800/30 to-violet-800/10 rounded-2xl border border-slate-700/50">
            <div class="w-14 h-14 bg-blue-500/10 rounded-full flex items-center justify-center text-blue-400 text-2xl mr-4 shrink-0">
                <i class="fas fa-bolt"></i>
            </div>
            <div>
                <h4 class="font-bold text-white mb-1">Proses Kilat</h4>
                <p class="text-xs text-gray-400 leading-relaxed">Pesanan diproses otomatis oleh sistem 24 jam non-stop.</p>
            </div>
        </div>
        <div class="flex items-center p-5 bg-gradient-to-r from-violet-800/30 to-violet-800/10 rounded-2xl border border-slate-700/50">
            <div class="w-14 h-14 bg-green-500/10 rounded-full flex items-center justify-center text-green-400 text-2xl mr-4 shrink-0">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div>
                <h4 class="font-bold text-white mb-1">Jaminan Aman</h4>
                <p class="text-xs text-gray-400 leading-relaxed">Transaksi legal 100% dengan metode pembayaran resmi.</p>
            </div>
        </div>
        <div class="flex items-center p-5 bg-gradient-to-r from-violet-800/30 to-violet-800/10 rounded-2xl border border-slate-700/50">
            <div class="w-14 h-14 bg-purple-500/10 rounded-full flex items-center justify-center text-purple-400 text-2xl mr-4 shrink-0">
                <i class="fas fa-tags"></i>
            </div>
            <div>
                <h4 class="font-bold text-white mb-1">Harga Terbaik</h4>
                <p class="text-xs text-gray-400 leading-relaxed">Dapatkan harga termurah untuk reseller dan pengguna.</p>
            </div>
        </div>
    </div>
</div>
@endsection