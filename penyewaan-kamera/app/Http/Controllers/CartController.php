<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Produk;
use Carbon\Carbon;

class CartController extends Controller
{
    /**
     * Menambahkan produk ke keranjang
     */
    public function tambahKeKeranjang(Request $request)
{
    // ✅ Validasi input
    $request->validate([
        'produks_id' => 'required|exists:produks,id',
        'jumlah_item' => 'required|integer|min:1',
        'waktu_pengambilan' => 'required|date',
        'tanggal_pengembalian' => 'required|date|after_or_equal:waktu_pengambilan',
    ]);

    // ✅ Ambil data produk
    $produk = Produk::findOrFail($request->produks_id);

    // ✅ Parsing waktu pengambilan dan tanggal pengembalian
    $waktu_pengambilan = Carbon::parse($request->waktu_pengambilan);
    $tanggal_pengembalian = Carbon::parse($request->tanggal_pengembalian);

    // ✅ Set waktu pengembalian = tanggal pengembalian + jam yg sama dgn pengambilan
    $waktu_pengembalian = $tanggal_pengembalian->copy()->setTime(
        $waktu_pengambilan->hour,
        $waktu_pengambilan->minute,
        $waktu_pengambilan->second
    );

    // ✅ Hitung durasi sewa dalam hari
    $durasi_sewa = $waktu_pengambilan->diffInDays($waktu_pengembalian);
    if ($durasi_sewa < 1) {
        $durasi_sewa = 1; // Minimal 1 hari
    }

    // ✅ Hitung subtotal
    $sub_total = $produk->harga * $request->jumlah_item * $durasi_sewa;

    // ✅ Simpan ke tabel cart
    Cart::create([
        'users_id' => Auth::id(),
        'produks_id' => $produk->id,
        'jumlah_item' => $request->jumlah_item,
        'waktu_pengambilan' => $waktu_pengambilan,
        'waktu_pengembalian' => $waktu_pengembalian,
        'harga' => $produk->harga,
        'sub_total' => $sub_total,
    ]);

    return redirect()->route('cart.index')->with('success', 'Berhasil ditambahkan ke keranjang!');
}


    /**
     * Menampilkan isi keranjang user
     */
    public function index()
    {
        $keranjang = Cart::where('users_id', Auth::id())->with('produk')->get();
        return view('cart', compact('keranjang'));
    }
}
