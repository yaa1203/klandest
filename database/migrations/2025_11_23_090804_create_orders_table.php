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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_code')->unique();
            
            // Data Pengiriman
            $table->string('nama_penerima');
            $table->string('no_hp');
            $table->text('alamat');
            
            // Pembayaran
            $table->enum('metode_pembayaran', ['cod', 'ovo', 'dana', 'gopay']);
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['menunggu', 'diterima', 'ditolak'])->nullable();
            
            // Order Details
            $table->decimal('total', 15, 2);
            $table->text('catatan')->nullable();
            
            // Status Order: pending, confirmed, packed, shipped, completed, canceled
            $table->enum('status', ['pending', 'confirmed', 'packed', 'shipped', 'completed', 'canceled'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};