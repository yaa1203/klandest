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
        'shopee_link',
    ];

    // Relasi dengan Wishlist
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Relasi many-to-many dengan User melalui wishlist
    public function wishlistedByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    // Method untuk cek apakah produk ada di wishlist user tertentu
    public function isWishlistedBy($user)
    {
        if (!$user) {
            return false;
        }
        
        return $this->wishlists()->where('user_id', $user->id)->exists();
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