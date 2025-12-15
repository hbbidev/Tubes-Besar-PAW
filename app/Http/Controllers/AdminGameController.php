<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminGameController extends Controller
{
    /**
     * Menampilkan daftar semua game.
     */
    public function index()
    {
        $games = Game::all();
        return view('admin.games.index', compact('games'));
    }

    /**
     * Menampilkan form untuk menambah game baru.
     */
    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Menyimpan data game baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'currency_name' => 'required|string|max:100', // misal: Diamond, UC, CP
            'thumbnail' => 'required|url', // Wajib URL gambar valid
        ]);

        Game::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'currency_name' => $request->currency_name,
            'thumbnail' => $request->thumbnail,
            'publisher' => $request->publisher ?? 'Unknown',
        ]);

        return redirect()->route('games.index')->with('success', 'Game berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit game sekaligus daftar item di dalamnya.
     */
    public function edit(Game $game)
    {
        // Load relasi items agar bisa ditampilkan di halaman edit
        $game->load('items'); 
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Memperbarui data game yang sudah ada.
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'currency_name' => 'required|string|max:100',
            'thumbnail' => 'required|url',
        ]);

        $game->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Update slug jika nama berubah
            'currency_name' => $request->currency_name,
            'thumbnail' => $request->thumbnail,
        ]);

        return redirect()->route('games.index')->with('success', 'Game berhasil diperbarui!');
    }

    /**
     * Menghapus game beserta item-item di dalamnya (karena on delete cascade).
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game berhasil dihapus!');
    }

    // ==========================================
    // LOGIKA KELOLA ITEM (NOMINAL TOPUP)
    // ==========================================

    /**
     * Menambahkan item/nominal baru ke dalam game tertentu.
     */
    public function storeItem(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required|string', // misal: 100 Diamond
            'price' => 'required|numeric|min:0',
        ]);

        // Simpan item melalui relasi games()->items()
        $game->items()->create([
            'name' => $request->name,
            'price' => $request->price,
            'is_active' => true
        ]);

        return back()->with('success', 'Item berhasil ditambahkan!');
    }

    /**
     * Menghapus item/nominal dari game.
     */
    public function destroyItem(Item $item)
    {
        $item->delete();
        return back()->with('success', 'Item berhasil dihapus!');
    }
}