<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // ID utama
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('produks_id')->constrained('produks')->onDelete('cascade');
            $table->integer('jumlah_item');
            $table->dateTime('waktu_pengambilan');
            $table->dateTime('waktu_pengembalian');
            $table->integer('harga');
            $table->integer('sub_total');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
