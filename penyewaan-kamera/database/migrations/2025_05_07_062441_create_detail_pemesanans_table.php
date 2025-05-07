<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detailpemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanans_id')->constrained('pemesanans')->onDelete('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('produks_id')->constrained('produks')->onDelete('cascade');
            $table->integer('jumlah_item');
            $table->dateTime('waktu_pengambilan');
            $table->dateTime('waktu_pengembalian')->nullable();
            $table->decimal('harga', 15, 2);
            $table->decimal('sub_total', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detailpemesanans');
    }
};
