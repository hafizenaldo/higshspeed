<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    // ➤ Static method untuk daftar kategori default
    public static function defaultList()
    {
        return [
            'kamera',
            'lensa',
            'camcorder',
            'stabilizer',
            'lampu foto',
            'lampu video',
            'actioncam',
            'speedlite',
            'drone',
        ];
    }

    // ➤ Inisialisasi otomatis jika belum ada
    public static function insertDefaultIfEmpty()
    {
        if (self::count() === 0) {
            foreach (self::defaultList() as $item) {
                self::create(['nama' => $item]);
            }
        }
    }
}
