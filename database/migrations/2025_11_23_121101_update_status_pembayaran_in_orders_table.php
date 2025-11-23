<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Jadikan nullable + kasih default
            $table->enum('status_pembayaran', ['menunggu', 'diterima', 'ditolak'])
                  ->nullable()
                  ->default(null)
                  ->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['menunggu', 'diterima', 'ditolak'])
                  ->default('menunggu')
                  ->change();
        });
    }
};