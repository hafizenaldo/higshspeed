<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CheckoutController extends Controller
{
    // ✅ Tampilkan halaman checkout
    public function index()
    {
        $user = Auth::user();

        // ✅ Ambil cart berdasarkan users_id (bukan user_id)
        $carts = Cart::where('users_id', $user->id)->get(); // ✅ FIXED: users_id sesuai tabel

        return view('checkout', [
            'carts' => $carts,
            'user' => $user // ✅ Dikirim agar bisa digunakan di view
        ]);
    }

    // ✅ Proses checkout (tanpa menyimpan ke tabel orders)
    public function store(Request $request)
    {
        // ✅ Validasi input user
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ]);

        $userId = Auth::id();

        // ✅ Hapus seluruh cart milik user
        Cart::where('users_id', $userId)->delete(); // ✅ FIXED: users_id

        return redirect()->route('checkout.success')->with('success', 'Checkout berhasil!');
    }

    // ✅ Halaman sukses
    public function success()
    {
        return view('checkout-success');
    }
}
