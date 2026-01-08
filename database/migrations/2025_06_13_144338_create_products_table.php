<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('merk');
            $table->decimal('harga', 10, 2);
            $table->string('ukuran');
            $table->string('gambar')->nullable();
            $table->text('deskripsi');
            $table->integer('stok');
            // $table->enum('status_pesanan', ['tersedia', 'dipesan', 'dikirim', 'selesai'])->default('tersedia');
            $table->string('kategori');
            $table->string('kode_produk')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
