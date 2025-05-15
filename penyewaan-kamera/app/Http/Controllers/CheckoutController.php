<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;

// 🔄 Midtrans
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    // ✅ Tampilkan halaman checkout
    public function index()
    {
        $user = Auth::user();
        $carts = Cart::where('users_id', $user->id)->get();

        return view('checkout', [
            'carts' => $carts,
            'user'  => $user
        ]);
    }

    // ✅ Proses checkout & simpan data ke database
    public function store(Request $request)
    {
        $userId = Auth::id();
        $carts = Cart::where('users_id', $userId)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong.');
        }

        DB::beginTransaction();

        try {
            $total = $carts->sum('sub_total');

            $pemesanan = Pemesanan::create([
                'users_id'          => $userId,
                'total'             => $total,
                'status_pembayaran' => 'pending',
                'link_pembayaran'   => null, // akan diisi setelah dapat Snap URL
            ]);

            foreach ($carts as $cart) {
                DetailPemesanan::create([
                    'pemesanans_id'      => $pemesanan->id,
                    'users_id'           => $userId,
                    'produks_id'         => $cart->produks_id,
                    'jumlah_item'        => $cart->jumlah_item,
                    'waktu_pengambilan'  => $cart->waktu_pengambilan,
                    'waktu_pengembalian' => $cart->waktu_pengembalian,
                    'harga'              => $cart->harga,
                    'sub_total'          => $cart->sub_total,
                ]);
            }

            // 🔄 Midtrans konfigurasi
            Config::$serverKey    = config('midtrans.serverKey');
            Config::$isProduction = config('midtrans.isProduction');
            Config::$isSanitized  = config('midtrans.isSanitized');
            Config::$is3ds        = config('midtrans.is3ds');

            // 🔄 Midtrans Snap Params
            $params = [
                'transaction_details' => [
                    'order_id'     => 'ORDER-' . $pemesanan->id . '-' . time(),
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email'      => Auth::user()->email,
                ],
            ];

            // 🔄 Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);

            // 🔄 Simpan Snap Token sebagai link pembayaran
            $pemesanan->update([
                'link_pembayaran' => $snapToken,
                'snap_token'      => $snapToken
            ]);

            // 🔄 Bersihkan keranjang
            Cart::where('users_id', $userId)->delete();

            DB::commit();

            // 🔄 Redirect ke halaman Snap
            return view('checkout-midtrans', [
            'snapToken' => $snapToken,
            'user' => Auth::user(),
            'pemesanan' => $pemesanan,
            'detailPemesanan' => DetailPemesanan::where('pemesanans_id', $pemesanan->id)->get()
        ]);


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    // ✅ Halaman sukses opsional
    public function success()
    {
        return view('checkout-success');
    }

    // CheckoutController.php
    public function updateStatus(Request $request)
    {
        $pemesanan = Pemesanan::where('id', $request->order_id)->first();
        if ($pemesanan) {
            $pemesanan->status_pembayaran = 'paid'; // mengubah status jadi paid
            $pemesanan->save();

            return response()->json(['message' => 'Status diperbarui']);
        }

        return response()->json(['message' => 'Pemesanan tidak ditemukan'], 404);
    }




    // ✅ Tambahan: Tampilkan riwayat pemesanan user
    public function riwayat()
    {
        $userId = Auth::id();

        $pemesanans = Pemesanan::where('users_id', $userId)
            ->with('detailpemesanans')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayat-pemesanan', compact('pemesanans'));
    }
}
