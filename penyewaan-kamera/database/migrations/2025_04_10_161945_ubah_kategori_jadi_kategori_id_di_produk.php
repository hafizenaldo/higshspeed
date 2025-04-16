<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UbahKategoriJadiKategoriIdDiProduk extends Migration
{
    /**
     * Ubah kolom kategori menjadi kategori_id.
     */
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Hapus kolom string kategori jika ada
            if (Schema::hasColumn('produks', 'kategori')) {
                $table->dropColumn('kategori');
            }

            // Tambahkan kategori_id sebagai foreign key
            $table->unsignedBigInteger('kategori_id')->nullable()->after('nama_produk');

            // Foreign key ke tabel kategoris
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('set null');
        });
    }

    /**
     * Rollback perubahan
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Hapus foreign key dan kolom kategori_id
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');

            // Tambahkan kembali kolom kategori jika perlu
            $table->string('kategori')->nullable();
        });
    }
}
