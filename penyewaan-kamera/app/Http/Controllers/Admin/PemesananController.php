<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    // Tampilkan semua pemesanan
    public function index()
    {
        $pemesanans = Pemesanan::with('user')->latest()->paginate(10);
        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    // Tampilkan detail 1 pemesanan
    public function show($id)
    {
        // DIUBAH: ganti 'detailPemesanan.produk' jadi 'details.produk'
        $pemesanan = Pemesanan::with(['user', 'details.produk'])->findOrFail($id);
        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    // Tampilkan form edit status pembayaran
    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return view('admin.pemesanan.edit', compact('pemesanan'));
    }

    // Update status pembayaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:pending,paid,expired,canceled',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status_pembayaran = $request->status_pembayaran;
        $pemesanan->save();

        return redirect()->route('pemesanan.index')->with('success', 'Status pembayaran berhasil diupdate');
    }

    // Hapus pemesanan
    public function destroy($id)
    {
        $pemesanan = Pemesanan::find($id);
        if (!$pemesanan) {
            return redirect()->route('pemesanan.index')->with('error', 'Data tidak ditemukan');
        }

        $pemesanan->delete();
        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus');
    }
}
