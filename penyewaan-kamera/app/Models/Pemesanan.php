<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans'; // Ubah ke 'pemesanan' jika Anda ganti nama tabel

    protected $fillable = [
        'users_id',
        'total',
        'link_pembayaran',
        'status_pembayaran',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function details() {
        return $this->hasMany(DetailPemesanan::class, 'pemesanans_id');
    }

    public function detailpemesanans()
    {
        return $this->hasMany(DetailPemesanan::class, 'pemesanans_id');
    }

}
