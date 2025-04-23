<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Menampilkan semua produk
     */


     public function index(Request $request)
     {
         $query = Produk::with('kategori'); // pastikan relasi kategori disertakan

         // Filter pencarian
         if ($request->has('search') && $request->search != '') {
             $search = $request->search;

             $query->where(function ($q) use ($search) {
                 $q->where('nama_produk', 'like', '%' . $search . '%')
                   ->orWhereHas('kategori', function ($kategoriQuery) use ($search) {
                       $kategoriQuery->where('nama', 'like', '%' . $search . '%');
                   });
             });
         }

         $produks = $query->get();

         return view('admin.produk.index', compact('produks'));
     }

        //menampilkan detail produk
         public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produkdetail', compact('produk'));
    }


    /**
     * Form tambah produk
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_produk', 'public');
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Form edit produk
     */
    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update data produk
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $produk->foto = $request->file('foto')->store('foto_produk', 'public');
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'foto' => $produk->foto,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk
     */
    public function destroy(Produk $produk)
    {
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

}
