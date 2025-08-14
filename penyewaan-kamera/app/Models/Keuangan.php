<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'jenis_transaksi',
        'keterangan',
        'jumlah',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
