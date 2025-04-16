<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // ✅ Kolom yang boleh diisi massal (mass assignment)
    protected $fillable = [
        'nama_produk',    // Nama produk
        'kategori_id',    // ID dari tabel kategoris (foreign key)
        'harga',          // Harga produk
        'deskripsi',      // Deskripsi produk
        'stok',           // Jumlah stok
        'foto'            // Path ke file foto (jika ada)
    ];

    // ✅ Relasi: Produk milik satu kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
