<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ViewprodukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        $kategoris = Kategori::all(); // Ambil semua kategori

        return view('viewproduk', compact('produks', 'kategoris'));
    }

    public function byKategori(Kategori $kategori)
    {
        $produks = Produk::with('kategori')->where('kategori_id', $kategori->id)->get();
        $kategoris = Kategori::all();

        return view('viewproduk', compact('produks', 'kategoris'));
    }
}
