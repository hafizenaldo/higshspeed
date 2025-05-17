<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Pemesanan;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.serverKey'); // ambil dari config atau .env
        $json = $request->getContent();
        $signatureKey = $request->header('X-Signature'); // atau gunakan $request->signature_key

        $data = json_decode($json, true);

        // Validasi signature Midtrans (keamanan)
        $hashed = hash('sha512',
            $data['order_id'] .
            $data['status_code'] .
            $data['gross_amount'] .
            $serverKey
        );

        if ($signatureKey !== $hashed) {
            Log::warning('Signature tidak valid');
            return response(['message' => 'Invalid signature'], 403);
        }

        // Temukan pemesanan berdasarkan order_id
        $pemesanan = Pemesanan::where('no_transaksi', $data['order_id'])->first();

        if (!$pemesanan) {
            Log::warning('Pemesanan tidak ditemukan');
            return response(['message' => 'Pemesanan tidak ditemukan'], 404);
        }

        // Update status pembayaran berdasarkan status Midtrans
        $transactionStatus = $data['transaction_status'];

        if ($transactionStatus == 'settlement') {
            $pemesanan->status_pembayaran = 'success';
        } elseif ($transactionStatus == 'pending') {
            $pemesanan->status_pembayaran = 'pending';
        } elseif ($transactionStatus == 'expire') {
            $pemesanan->status_pembayaran = 'expired';
        } elseif ($transactionStatus == 'cancel') {
            $pemesanan->status_pembayaran = 'canceled';
        } elseif ($transactionStatus == 'deny') {
            $pemesanan->status_pembayaran = 'denied';
        }

        $pemesanan->save();

        // Log untuk debug
        Log::info('Webhook diterima dan status diperbarui', $data);

        return response()->json(['message' => 'Success']);
    }
}
