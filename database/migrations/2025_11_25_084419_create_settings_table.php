<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // Insert default values
        DB::table('settings')->insert([
            // Contact Info
            ['key' => 'whatsapp_number', 'value' => '6281234567890', 'group' => 'contact', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'whatsapp_text', 'value' => 'Halo Klandest 👋 Saya mau tanya tentang...', 'group' => 'contact', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'email', 'value' => 'info@klandest.com', 'group' => 'contact', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'phone', 'value' => '+62 812-3456-7890', 'group' => 'contact', 'created_at' => now(), 'updated_at' => now()],
            
            // Address
            ['key' => 'address_line1', 'value' => 'Jl. Raya Klandest No. 99', 'group' => 'address', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'address_line2', 'value' => 'Jakarta Selatan, DKI Jakarta 12790', 'group' => 'address', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'address_country', 'value' => 'Indonesia', 'group' => 'address', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'maps_embed_url', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.074!2d106.791!3d-6.259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTUnMzIuNCI!5e0!3m2!1sid!2sid!4v1234567890', 'group' => 'address', 'created_at' => now(), 'updated_at' => now()],
            
            // Social Media
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/klandest', 'group' => 'social', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'tiktok_url', 'value' => 'https://tiktok.com/@klandest', 'group' => 'social', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/klandest', 'group' => 'social', 'created_at' => now(), 'updated_at' => now()],
            
            // Operating Hours
            ['key' => 'operating_days', 'value' => 'Senin - Minggu', 'group' => 'hours', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'operating_hours', 'value' => '08:00 - 22:00 WIB', 'group' => 'hours', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};