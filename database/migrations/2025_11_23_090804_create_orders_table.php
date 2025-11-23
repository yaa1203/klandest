<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // database/migrations/xxxx_create_orders_table.php
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('order_code');
            $table->string('nama_penerima');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('metode_pembayaran');
            $table->text('catatan')->nullable();
            $table->decimal('total', 15, 2);
            $table->enum('status', ['pending', 'confirmed', 'packed', 'shipped', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};