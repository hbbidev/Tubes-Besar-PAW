<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Item;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function show($slug)
    {
        $game = Game::with(['items' => function($q) {
            $q->where('is_active', 1)->orderBy('price', 'asc');
        }])->where('slug', $slug)->firstOrFail();

        $payments = PaymentMethod::where('is_active', 1)->get();

        return view('order', compact('game', 'payments'));
    }

    public function process(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'item_id' => 'required|exists:items,id',
            'target_id' => 'required|string',
        ]);

        $item = Item::find($request->item_id);
        
        // Buat Invoice ID Unik
        $invoice = 'TRX-' . time() . rand(100,999);
        
        // 2. Simpan Transaksi (Status Awal: PENDING)
        $trx = Transaction::create([
            'invoice' => $invoice,
            'user_id' => auth()->id(),
            'item_id' => $item->id,
            'payment_method_id' => $request->payment_method_id ?? 1,
            'target_id' => $request->target_id,
            'server_id' => $request->server_id,
            'amount' => $item->price, 
            'status' => 'PENDING',
        ]);

        // 3. Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 4. Siapkan Parameter Snap
        $params = [
            'transaction_details' => [
                'order_id' => $trx->invoice,
                'gross_amount' => (int) $trx->amount,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => $item->id,
                    'price' => (int) $item->price,
                    'quantity' => 1,
                    'name' => $item->name,
                ]
            ]
        ];

        // 5. Ambil Snap Token & Redirect
        try {
            $snapToken = Snap::getSnapToken($params);
            $trx->update(['snap_token' => $snapToken]);
            
            return redirect()->route('payment.show', $trx->invoice);

        } catch (\Exception $e) {
            dd("Error Midtrans: " . $e->getMessage());
        }
    }

    public function showPayment($invoice)
    {
        $transaction = Transaction::with(['item.game'])->where('invoice', $invoice)->firstOrFail();
        return view('payment', compact('transaction'));
    }
    
    // --- FITUR UPDATE STATUS SETELAH BAYAR ---
    // Method ini dipanggil saat redirect onSuccess dari payment.blade.php
    public function success(Request $request)
    {
        // Ambil invoice dari URL (?invoice=TRX-...)
        $invoice = $request->query('invoice');

        if ($invoice) {
            // Cari transaksi di database
            $trx = Transaction::where('invoice', $invoice)->first();

            // Validasi: Pastikan transaksi ada dan milik user yang sedang login
            if ($trx && $trx->user_id == auth()->id()) {
                // UPDATE STATUS JADI SUCCESS (DONE)
                $trx->update(['status' => 'DONE']);
            }
        }

        // Kembalikan ke dashboard dengan pesan sukses
        return redirect()->route('member.dashboard')->with('success', 'Pembayaran Berhasil! Item sedang diproses.');
    }
}