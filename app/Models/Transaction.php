<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // FIX PENTING: Izinkan semua kolom diisi agar tidak error saat Order
    protected $guarded = [];

    // Relasi: Transaksi membeli satu Item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relasi: Transaksi menggunakan satu Metode Pembayaran
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}