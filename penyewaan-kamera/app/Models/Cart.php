<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'produks_id',
        'jumlah_item',
        'waktu_pengambilan',
        'waktu_pengembalian',
        'harga',
        'sub_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produks_id');
    }
}
