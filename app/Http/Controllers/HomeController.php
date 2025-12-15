<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Fitur Pencarian
        $query = Game::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $games = $query->get();

        return view('home', compact('games'));
    }
}