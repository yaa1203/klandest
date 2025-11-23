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
}
