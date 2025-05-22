<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Pemesanan;
use App\Mail\InvoiceMail;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.serverKey'); // ambil dari config atau .env
        $json = $request->getContent();
        $signatureKey = $request->header('X-Signature'); // atau gunakan $request->signature_key

        $data = json_decode($json, true);

        // ✏️ Validasi signature Midtrans (keamanan)
        $hashed = hash('sha512',
            $data['order_id'] .
            $data['status_code'] .
            $data['gross_amount'] .
            $serverKey
        );

        if ($request->signature_key !== $hashed) {
            Log::warning('❌ Signature tidak valid');
            return response(['message' => 'Invalid signature'], 403);
        }

        // ✏️ Ambil ID dari order_id Midtrans (misal: ORDER-1)
        $order_id = explode('-', $data['order_id']);
        $pemesanan = Pemesanan::where('id', $order_id[1])->first();

        if (!$pemesanan) {
            Log::warning('❌ Pemesanan tidak ditemukan');
            return response(['message' => 'Pemesanan tidak ditemukan'], 404);
        }

        // ✏️ Update status pembayaran
        $transactionStatus = $data['transaction_status'];

        if ($transactionStatus == 'settlement') {
            $pemesanan->status_pembayaran = 'paid';
            $pemesanan->save(); // ✅ Simpan dulu baru kirim email

            // ✅ Kirim email invoice ke pelanggan
            try {
                if ($pemesanan->user && $pemesanan->user->email) {
                    Mail::to($pemesanan->user->email)->send(new InvoiceMail($pemesanan));
                    Log::info('✅ Invoice berhasil dikirim ke email pelanggan', [
                        'email' => $pemesanan->user->email
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('❌ Gagal mengirim email invoice: ' . $e->getMessage());
            }

        } elseif ($transactionStatus == 'pending') {
            $pemesanan->status_pembayaran = 'pending';
            $pemesanan->save();
        } elseif ($transactionStatus == 'expire') {
            $pemesanan->status_pembayaran = 'expired';
            $pemesanan->save();
        } elseif ($transactionStatus == 'cancel') {
            $pemesanan->status_pembayaran = 'canceled';
            $pemesanan->save();
        } elseif ($transactionStatus == 'deny') {
            $pemesanan->status_pembayaran = 'denied';
            $pemesanan->save();
        }

        // ✅ Log webhook
        Log::info('✅ Webhook diterima dan status diperbarui', $data);

        return response()->json(['message' => 'Success']);
    }
}
