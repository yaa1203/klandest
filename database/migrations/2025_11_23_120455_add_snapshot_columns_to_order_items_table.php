<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Cek dulu kolom product_id / produk_id ada yang mana
            $hasProductId = Schema::hasColumn('order_items', 'product_id');
            $hasProdukId = Schema::hasColumn('order_items', 'produk_id');

            // Tambahkan kolom snapshot (tanpa AFTER, biar aman)
            $table->string('nama_produk')->after($hasProductId ? 'product_id' : ($hasProdukId ? 'produk_id' : 'id'));
            $table->string('foto_produk')->nullable()->after('nama_produk');
            $table->string('slug')->nullable()->after('foto_produk');
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['nama_produk', 'foto_produk', 'slug']);
        });
    }
};