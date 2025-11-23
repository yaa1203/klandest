<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_payment_proof_to_orders_table.php
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->after('catatan'); // path foto
            $table->enum('status_pembayaran', ['menunggu', 'diterima', 'ditolak'])
                ->default('menunggu')->after('bukti_pembayaran');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['bukti_pembayaran', 'status_pembayaran']);
        });
    }
};
