<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    // MENGIZINKAN SEMUA KOLOM DIISI
    protected $guarded = [];

    // Relasi: Game punya banyak Item
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}