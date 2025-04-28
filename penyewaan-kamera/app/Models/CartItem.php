<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produk_id',
        'harga',
        'jumlah_item',
        'tanggal_pengambilan',
        'tanggal_pengembalian',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
