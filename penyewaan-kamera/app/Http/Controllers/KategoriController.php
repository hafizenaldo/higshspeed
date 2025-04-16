<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $kategoris = Kategori::when($search, function ($query, $search) {
        return $query->where('nama', 'like', '%' . $search . '%');
    })->get();

    return view('admin.kategori.index', compact('kategoris'));
}

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|unique:kategoris,nama']);
        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(['nama' => 'required']);
        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori dihapus.');
    }
}
