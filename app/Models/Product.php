<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'harga',
        'deskripsi',
        'gambar',
        'kategori_id',
        'shopee_link', // Tambahkan ini
    ];

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function wishlist()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id');
    }

    public function isWishlistedBy(User $user)
    {
        return $this->wishlist()->where('user_id', $user->id)->exists();
    }

    // Relasi ke Order Items (opsional, untuk tracking penjualan)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper untuk format harga (opsional)
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Helper untuk URL gambar (opsional)
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : asset('images/no-image.png');
    }
}