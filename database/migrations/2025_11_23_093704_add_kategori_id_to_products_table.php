<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Di file migration add_kategori_id_to_products_table

    public function up(): void
    {
        // Langkah 1: Tambah kolom dulu sebagai nullable
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->after('id');
        });

        // Langkah 2: Isi semua produk yang belum punya kategori dengan kategori default
        // Misalnya buat kategori "Umum" atau "Lainnya"
        \DB::statement("UPDATE products SET kategori_id = 1 WHERE kategori_id IS NULL");

        // Langkah 3: Ubah jadi not nullable + tambah foreign key
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable(false)->change();
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }
};