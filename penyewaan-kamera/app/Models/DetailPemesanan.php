<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    use HasFactory;

    protected $table = 'detailpemesanans'; // Nama tabel

    protected $fillable = [
        'pemesanans_id',
        'users_id',
        'produks_id',
        'jumlah_item',
        'waktu_pengambilan',
        'waktu_pengembalian',
        'harga',
        'sub_total',
    ];

    // Relasi ke pemesanan
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanans_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produks_id');
    }
    
}
