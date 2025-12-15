@extends('layouts.app')

@section('title', 'Edit Game')

@section('content')
<div class="container mx-auto max-w-7xl grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Header Mobile (Optional for breadcrumb context) -->
    <div class="lg:col-span-3 mb-2 flex items-center text-sm text-gray-400">
        <a href="{{ route('games.index') }}" class="hover:text-white transition flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Game
        </a>
    </div>

    <!-- Kolom Kiri: Form Edit Info Game -->
    <div class="lg:col-span-1">
        <div class="glass-panel p-6 rounded-xl border border-slate-700 sticky top-24 shadow-xl">
            <h2 class="text-xl font-bold mb-6 text-white border-b border-slate-700 pb-4 flex items-center">
                <i class="fas fa-edit mr-2 text-blue-500"></i> Edit Info Game
            </h2>
            
            <form action="{{ route('games.update', $game->id) }}" method="POST" class="space-y-5">
                @csrf @method('PUT')
                
                <div class="text-center mb-6">
                    <img src="{{ $game->thumbnail }}" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-slate-600 shadow-md mb-2">
                    <p class="text-xs text-gray-500 italic">Preview Thumbnail Saat Ini</p>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-gray-500 font-bold mb-1">Nama Game</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-gamepad"></i>
                        </span>
                        <input type="text" name="name" value="{{ $game->name }}" class="w-full bg-gray-700/10 border border-slate-600 rounded-lg p-2.5 pl-10 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-gray-500 font-bold mb-1">Mata Uang</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-coins"></i>
                        </span>
                        <input type="text" name="currency_name" value="{{ $game->currency_name }}" class="w-full bg-gray-700/10 border border-slate-600 rounded-lg p-2.5 pl-10 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-gray-500 font-bold mb-1">URL Thumbnail</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-link"></i>
                        </span>
                        <input type="url" name="thumbnail" value="{{ $game->thumbnail }}" class="w-full bg-gray-700/10 border border-slate-600 rounded-lg p-2.5 pl-10 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition text-sm" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-500 py-3 rounded-lg font-bold shadow-lg transition mt-4 flex justify-center items-center transform hover:scale-[1.02]">
                    <i class="fas fa-sync-alt mr-2"></i> Update Informasi
                </button>
            </form>
        </div>
    </div>

    <!-- Kolom Kanan: Kelola Nominal (Items) -->
    <div class="lg:col-span-2">
        <div class="glass-panel p-6 rounded-xl border border-slate-700 h-full shadow-xl">
            <div class="flex justify-between items-center mb-6 border-b border-slate-700 pb-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-list-ul mr-2 text-purple-500"></i> Daftar Nominal Topup
                </h2>
                <span class="text-xs bg-gray-700/10 px-3 py-1 rounded-full text-gray-400 border border-slate-600">
                    Total: {{ $game->items->count() }} Item
                </span>
            </div>
            
            <!-- Form Tambah Item Baru -->
            <div class="bg-gray-800/10 p-5 rounded-xl mb-8 border border-slate-700/50 backdrop-blur-sm">
                <h3 class="text-sm font-bold mb-4 text-violet-400 uppercase tracking-wide flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Nominal Baru
                </h3>
                <form action="{{ route('games.items.store', $game->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-5">
                            <label class="block text-xs text-gray-500 mb-1">Nama Item</label>
                            <input type="text" name="name" placeholder="Cth: 100 Diamonds" class="w-full bg-gray-700/10 border border-slate-600 rounded-lg p-2.5 text-white focus:border-blue-500 outline-none transition" required>
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-xs text-gray-500 mb-1">Harga (Rp)</label>
                            <input type="number" name="price" placeholder="Cth: 20000" class="w-full bg-gray-700/10 border border-slate-600 rounded-lg p-2.5 text-white focus:border-blue-500 outline-none transition" required>
                        </div>
                        <div class="md:col-span-3 flex items-end">
                            <button type="submit" class="w-full bg-violet-600 hover:bg-violet-500 py-2.5 rounded-lg text-sm font-bold transition shadow-lg flex justify-center items-center">
                                <i class="fas fa-plus mr-1"></i> Tambah
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Daftar Item -->
            <div class="overflow-hidden rounded-xl border border-slate-700 bg-gray-700/10">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-700/20 text-gray-400 font-semibold uppercase text-xs">
                        <tr>
                            <th class="py-3 px-4">Nama Item</th>
                            <th class="py-3 px-4">Harga</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($game->items as $item)
                        <tr class="hover:bg-slate-800/50 transition duration-150 group">
                            <td class="py-3 px-4 font-medium text-white group-hover:text-blue-400 transition">{{ $item->name }}</td>
                            <td class="py-3 px-4 text-green-400 font-mono">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-right">
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-white hover:bg-red-500 px-3 py-1.5 rounded transition text-xs border border-red-500/30 hover:border-red-500 flex items-center justify-center ml-auto" title="Hapus Item">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-12 text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-box-open text-4xl mb-3 opacity-30"></i>
                                    <p>Belum ada item/nominal untuk game ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection