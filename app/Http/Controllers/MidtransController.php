<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    /**
     * Handle Midtrans Notification (Webhook)
     * URL ini dipanggil oleh server Midtrans, bukan user.
     */
    public function callback(Request $request)
    {
        // 1. Set Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        try {
            // 2. Terima Notifikasi
            $notif = new Notification();
            
            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;

            // 3. Cari Transaksi di Database
            $trx = Transaction::where('invoice', $order_id)->first();

            if (!$trx) {
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            // 4. Update Status Berdasarkan Respon Midtrans
            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $trx->update(['status' => 'PENDING']);
                    } else {
                        $trx->update(['status' => 'DONE']);
                    }
                }
            } else if ($transaction == 'settlement') {
                // Settlement = Pembayaran sukses masuk
                $trx->update(['status' => 'DONE']); 
            } else if ($transaction == 'pending') {
                $trx->update(['status' => 'PENDING']);
            } else if ($transaction == 'deny') {
                $trx->update(['status' => 'FAILED']);
            } else if ($transaction == 'expire') {
                $trx->update(['status' => 'FAILED']);
            } else if ($transaction == 'cancel') {
                $trx->update(['status' => 'FAILED']);
            }

            return response()->json(['message' => 'Notification processed successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error processing notification: ' . $e->getMessage()], 500);
        }
    }
}