<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;

class CheckoutController extends Controller
{
    // ✅ Tampilkan halaman checkout
    public function index()
    {
        $user = Auth::user();

        $carts = Cart::where('users_id', $user->id)->get();

        return view('checkout', [
            'carts' => $carts,
            'user' => $user
        ]);
    }

    // ✅ Proses checkout & simpan data
    public function store(Request $request)
    {

        // $request->validate([
        //     'name'  => 'required|string|max:255',
        //     'email' => 'required|email',
        //     'phone' => 'required|string|max:15',
        // ]);

        $userId = Auth::id();
        $carts = Cart::where('users_id', $userId)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong.');
        }

        DB::beginTransaction();

        try {
            // ✅ Hitung total dari semua sub_total
            $total = $carts->sum('sub_total');

            // ✅ Simpan ke tabel pemesanans
            $pemesanan = Pemesanan::create([
                'users_id'          => $userId,
                'total'             => $total,
                'status_pembayaran' => 'pending',
                'link_pembayaran'   => null, // bisa diganti dengan URL midtrans jika sudah ada
            ]);

            // ✅ Simpan ke tabel detailpemesanans
            foreach ($carts as $cart) {
                DetailPemesanan::create([
                    'pemesanans_id'     => $pemesanan->id,
                    'users_id'          => $userId,
                    'produks_id'        => $cart->produks_id,
                    'jumlah_item'       => $cart->jumlah_item,
                    'waktu_pengambilan' => $cart->waktu_pengambilan,
                    'waktu_pengembalian'=> $cart->waktu_pengembalian,
                    'harga'             => $cart->harga,
                    'sub_total'         => $cart->sub_total,
                ]);
            }

            // ✅ Kosongkan keranjang
            Cart::where('users_id', $userId)->delete();

            DB::commit();

            return redirect()->route('checkout.success')->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            DD($e->getMessage());
            return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    // ✅ Halaman sukses
    public function success()
    {
        return view('checkout-success');
    }
}
