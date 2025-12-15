<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // MENGIZINKAN SEMUA KOLOM DIISI
    protected $guarded = [];

    // Relasi: Item milik satu Game
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}