<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar akun pelanggan
     */
    public function index()
    {
        // Ambil semua user dengan role pelanggan
        $pelanggan = User::where('role', 'pelanggan')->orderBy('created_at', 'desc')->get();

        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Menampilkan detail pelanggan
     */
    public function show($id)
    {
        $pelanggan = User::findOrFail($id);
        return view('admin.pelanggan.show', compact('pelanggan'));
    }

    /**
     * Menghapus akun pelanggan
     */
    public function destroy($id)
    {
        $pelanggan = User::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Akun pelanggan berhasil dihapus.');
    }
}
