@extends('layouts.app')

@section('title', 'Kelola Game')

@section('content')
<div class="container mx-auto max-w-6xl">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white">Kelola Game</h1>
            <p class="text-gray-400 text-sm mt-1">Atur daftar game dan mata uang virtual.</p>
        </div>
        <a href="{{ route('games.create') }}" class="bg-violet-700 hover:bg-violet-600 text-white px-6 py-2.5 rounded-xl font-bold transition shadow-lg flex items-center transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i> Tambah Game
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl mb-6 flex items-center shadow-lg backdrop-blur-sm">
            <div class="bg-green-500/20 p-2 rounded-full mr-3">
                <i class="fas fa-check"></i>
            </div>
            {{ session('success') }}
        </div>
    @endif

    <div class="glass-panel rounded-xl overflow-hidden shadow-2xl border border-slate-700/50">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-zinc-600/10 border-b border-slate-700 text-gray-400 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="p-5 font-semibold">Game Info</th>
                        <th class="p-5 font-semibold">Mata Uang</th>
                        <th class="p-5 font-semibold">Total Item</th>
                        <th class="p-5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($games as $game)
                    <tr class="hover:bg-gray-800/10 transition duration-150">
                        <td class="p-5">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $game->thumbnail }}" class="w-16 h-16 rounded-lg object-cover shadow-md border border-slate-600" alt="thumb" onerror="this.src='https://placehold.co/100x100?text=No+Img'">
                                <div>
                                    <div class="font-bold text-lg text-white">{{ $game->name }}</div>
                                    <div class="text-xs text-gray-500 font-mono mt-1">{{ $game->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-5">
                            <span class="bg-violet-500/10 text-violet-400 px-3 py-1 rounded-full text-xs font-bold border border-blue-500/20">
                                {{ $game->currency_name }}
                            </span>
                        </td>
                        <td class="p-5">
                            <span class="text-gray-300 font-medium">
                                <i class="fas fa-cubes mr-2 text-gray-500"></i> {{ $game->items->count() }} Nominal
                            </span>
                        </td>
                        <td class="p-5 text-right">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500/10 text-yellow-500 hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-lg transition text-sm font-medium border border-yellow-500/20">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus game ini? Semua item terkait akan ikut terhapus.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-lg transition text-sm font-medium border border-red-500/20">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-12">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <i class="fas fa-gamepad text-6xl mb-4 opacity-20"></i>
                                <p class="text-lg font-medium">Belum ada game</p>
                                <p class="text-sm">Mulai dengan menambahkan game baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection