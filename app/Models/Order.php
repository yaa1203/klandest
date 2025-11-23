<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * Kolom yang boleh diisi secara massal
     */
    protected $fillable = [
        'user_id',
        'order_code',
        'nama_penerima',
        'no_hp',
        'alamat',
        'metode_pembayaran', // cod, ovo, dana, gopay
        'catatan',
        'total',
        'status',             // pending, confirmed, processed, shipped, completed, canceled
        'bukti_pembayaran',   // path file bukti transfer
        'status_pembayaran',  // menunggu, diterima, ditolak
    ];

    /**
     * Cast attribute agar otomatis jadi tipe yang benar
     */
    protected $casts = [
        'total' => 'decimal:2',
    ];

    /**
     * Accessor tambahan agar tetap kompatibel kalau ada kode lama pakai total_price
     */
    protected $appends = ['total_price', 'total_formatted'];

    public function getTotalPriceAttribute()
    {
        return $this->total;
    }

    public function getTotalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    /**
     * Relasi
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // app/Models/Order.php → ganti fungsi getStatusBadgeAttribute()
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending'     => '<span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Menunggu Konfirmasi</span>',
            'confirmed'   => '<span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">Dikonfirmasi</span>',
            'packed'      => '<span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-medium">Sedang Dikemas</span>',
            'shipped'     => '<span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-medium">Dikirim</span>',
            'completed'   => '<span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Selesai</span>',
            'canceled'    => '<span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">Dibatalkan</span>',
            default       => '<span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-medium">Unknown</span>',
        };
    }

    /**
     * Badge Status Pembayaran (khusus e-wallet)
     */
    public function getStatusPembayaranBadgeAttribute()
    {
        return match ($this->status_pembayaran) {
            'menunggu'  => '<span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Menunggu Bukti</span>',
            'diterima'  => '<span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Pembayaran Diterima</span>',
            'ditolak'   => '<span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">Pembayaran Ditolak</span>',
            default     => '<span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-medium">—</span>',
        };
    }

    /**
     * Cek apakah ini pesanan COD
     */
    public function isCod()
    {
        return $this->metode_pembayaran === 'cod';
    }

    /**
     * Cek apakah ini pesanan e-wallet (perlu bukti transfer)
     */
    public function isEwallet()
    {
        return in_array($this->metode_pembayaran, ['ovo', 'dana', 'gopay']);
    }

    /**
     * URL bukti pembayaran (jika ada)
     */
    public function getBuktiUrlAttribute()
    {
        return $this->bukti_pembayaran ? asset('storage/' . $this->bukti_pembayaran) : null;
    }

    /**
     * Scope untuk pesanan yang menunggu pembayaran
     */
    public function scopeWaitingPayment($query)
    {
        return $query->where('status_pembayaran', 'menunggu')
                     ->whereIn('metode_pembayaran', ['ovo', 'dana', 'gopay']);
    }

    /**
     * Scope untuk pesanan COD (langsung diproses)
     */
    public function scopeCodOrders($query)
    {
        return $query->where('metode_pembayaran', 'cod');
    }
}