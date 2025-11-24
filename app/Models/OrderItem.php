<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'nama_produk',
        'harga',
        'quantity',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Akses foto langsung (optional)
    public function getFotoProdukAttribute()
    {
        return $this->produk?->foto ?? null;
    }

    public function getNamaProdukAttribute()
    {
        return $this->produk?->nama ?? 'Produk tidak ditemukan';
    }
}