<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Tambahkan semua kolom yang dibutuhkan + kasih default value biar aman
            if (!Schema::hasColumn('order_items', 'nama_produk')) {
                $table->string('nama_produk')->after('product_id');
            }
            if (!Schema::hasColumn('order_items', 'foto_produk')) {
                $table->string('foto_produk')->nullable()->after('nama_produk');
            }
            if (!Schema::hasColumn('order_items', 'harga_satuan')) {
                $table->decimal('harga_satuan', 15, 2)->default(0)->after('foto_produk');
            }
            if (!Schema::hasColumn('order_items', 'slug')) {
                $table->string('slug')->nullable()->after('harga_satuan');
            }
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['nama_produk', 'foto_produk', 'harga_satuan', 'slug']);
        });
    }
};