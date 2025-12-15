@extends('layouts.app')

@section('title', 'Tambah Game')

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="glass-panel p-8 rounded-xl border border-slate-700 shadow-2xl">
        <div class="flex justify-between items-center mb-8 border-b border-slate-700 pb-4">
            <h2 class="text-2xl font-bold text-white">Tambah Game Baru</h2>
            <a href="{{ route('games.index') }}" class="text-gray-400 hover:text-white transition">
                <i class="fas fa-times text-xl"></i>
            </a>
        </div>
        
        <form action="{{ route('games.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Nama Game -->
            <div>
                <label class="block text-sm mb-2 text-gray-300 font-semibold">Nama Game</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fas fa-gamepad"></i>
                    </span>
                    <input type="text" name="name" class="w-full bg-gray-800/10 border border-slate-600 rounded-lg py-3 pl-10 pr-4 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition placeholder-gray-600" placeholder="Contoh: Mobile Legends" required>
                </div>
            </div>

            <!-- Mata Uang -->
            <div>
                <label class="block text-sm mb-2 text-gray-300 font-semibold">Nama Mata Uang</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fas fa-coins"></i>
                    </span>
                    <input type="text" name="currency_name" class="w-full bg-gray-800/10 border border-slate-600 rounded-lg py-3 pl-10 pr-4 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition placeholder-gray-600" placeholder="Contoh: Diamonds, UC, CP" required>
                </div>
            </div>

            <!-- Thumbnail -->
            <div>
                <label class="block text-sm mb-2 text-gray-300 font-semibold">URL Thumbnail (Gambar)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fas fa-link"></i>
                    </span>
                    <input type="url" name="thumbnail" class="w-full bg-gray-800/10 border border-slate-600 rounded-lg py-3 pl-10 pr-4 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition placeholder-gray-600" placeholder="https://example.com/image.jpg" required>
                </div>
                <div class="mt-2 text-xs text-violet-400 bg-violet-500/10 p-2 rounded border border-violet-500/20">
                    <i class="fas fa-info-circle mr-1"></i> Tips: Cari gambar di Google, Klik Kanan > "Copy Image Address", lalu paste di sini.
                </div>
            </div>
            
            <div class="flex justify-end space-x-4 pt-6 mt-4 border-t border-slate-700">
                <a href="{{ route('games.index') }}" class="px-6 py-2.5 text-gray-400 hover:text-white hover:bg-slate-700 rounded-lg transition font-medium">Batal</a>
                <button type="submit" class="bg-violet-600 hover:bg-violet-500 text-white px-8 py-2.5 rounded-lg font-bold shadow-lg transition transform hover:scale-[1.02]">
                    <i class="fas fa-save mr-2"></i> Simpan Game
                </button>
            </div>
        </form>
    </div>
</div>
@endsection