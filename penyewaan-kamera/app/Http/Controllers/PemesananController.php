<?php


namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    // Tampilkan semua pemesanan
    public function index()
    {
        $pemesanans = Pemesanan::with('user')->latest()->get();
        return view('pemesanan.index', compact('pemesanans'));
    }

    // Tampilkan form tambah pemesanan
    public function create()
    {
        $users = User::all();
        return view('pemesanan.create', compact('users'));
    }

    // Simpan pemesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'link_pembayaran' => 'required|string',
            'status_pembayaran' => 'required|in:pending,paid,failed',
        ]);

        Pemesanan::create($request->all());

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dibuat.');
    }

    // Tampilkan detail satu pemesanan
    public function show(Pemesanan $pemesanan)
    {
        return view('pemesanan.show', compact('pemesanan'));
    }

    // Tampilkan form edit pemesanan
    public function edit(Pemesanan $pemesanan)
    {
        $users = User::all();
        return view('pemesanan.edit', compact('pemesanan', 'users'));
    }

    // Update data pemesanan
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'link_pembayaran' => 'required|string',
            'status_pembayaran' => 'required|in:pending,paid,failed',
        ]);

        $pemesanan->update($request->all());

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    // Hapus pemesanan
    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}
