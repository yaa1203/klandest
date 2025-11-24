<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // ============= USER SIDE =============
    
    /**
     * Daftar pesanan user
     */
    public function index(Request $request)
    {
        $query = auth()->user()->orders()->with('items')->latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10);

        return view('user.order.index', compact('orders'));
    }

    /**
     * User konfirmasi pesanan diterima
     */
    public function received($code)
    {
        $order = Order::where('order_code', $code)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum dikirim!');
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Pesanan telah ditandai sebagai selesai. Terima kasih!');
    }
    
    /**
     * Halaman Terima Kasih (untuk COD)
     */
    public function success($code)
    {
        $order = Order::with('items')->where('order_code', $code)->firstOrFail();
        
        return view('user.order.success', compact('order'));
    }

    /**
     * Halaman Pembayaran (untuk E-Wallet)
     */
    public function payment($code)
    {
        $order = Order::with('items')->where('order_code', $code)->firstOrFail();
        
        return view('user.order.payment', compact('order'));
    }

    /**
     * User upload bukti transfer
     */
    public function uploadProof(Request $request, $code)
    {
        $order = Order::where('order_code', $code)->firstOrFail();

        $request->validate([
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'bukti.required' => 'Bukti transfer wajib diupload',
            'bukti.image' => 'File harus berupa gambar',
            'bukti.mimes' => 'Format file harus JPG, JPEG, atau PNG',
            'bukti.max' => 'Ukuran file maksimal 2MB'
        ]);

        // Hapus bukti lama jika ada
        if ($order->bukti_pembayaran) {
            Storage::disk('public')->delete($order->bukti_pembayaran);
        }

        $path = $request->file('bukti')->store('bukti-pembayaran', 'public');

        $order->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'menunggu',
            'status' => 'pending' // Reset ke pending saat upload ulang
        ]);

        return back()->with('success', 'Bukti transfer berhasil dikirim! Admin akan segera memproses.');
    }

    // ============= ADMIN SIDE =============
    
    /**
     * Daftar semua pesanan (Admin)
     */
    public function adminIndex()
    {
        $orders = Order::with(['user', 'items'])
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Admin konfirmasi pembayaran e-wallet
     */
    public function confirm(Order $order)
    {
        // Untuk e-wallet yang sudah upload bukti
        if ($order->metode_pembayaran !== 'cod' && $order->bukti_pembayaran) {
            $order->update([
                'status_pembayaran' => 'diterima',
                'status' => 'confirmed'
            ]);
            return back()->with('success', "Pembayaran pesanan #{$order->order_code} telah dikonfirmasi!");
        }
        
        // Untuk COD atau yang belum upload bukti
        $order->update(['status' => 'confirmed']);
        return back()->with('success', "Pesanan #{$order->order_code} telah dikonfirmasi!");
    }

    /**
     * Admin tolak pembayaran e-wallet
     */
    public function reject(Order $order)
    {
        $order->update([
            'status_pembayaran' => 'ditolak',
            'status' => 'pending' // Beri kesempatan upload ulang
        ]);

        return back()->with('success', "Bukti pembayaran pesanan #{$order->order_code} ditolak. User dapat upload ulang.");
    }

    /**
     * Proses pesanan ke tahap dikemas
     */
    public function pack(Order $order)
    {
        $order->update(['status' => 'packed']);
        return back()->with('success', "Pesanan #{$order->order_code} sedang dikemas.");
    }

    /**
     * Kirim pesanan
     */
    public function ship(Order $order)
    {
        $order->update(['status' => 'shipped']);
        return back()->with('success', "Pesanan #{$order->order_code} telah dikirim!");
    }

    /**
     * Selesaikan pesanan
     */
    public function complete(Order $order)
    {
        $order->update(['status' => 'completed']);
        return back()->with('success', "Pesanan #{$order->order_code} selesai!");
    }

    /**
     * Batalkan pesanan
     */
    public function cancel(Order $order)
    {
        $order->update([
            'status' => 'canceled',
            'status_pembayaran' => 'ditolak'
        ]);

        return back()->with('success', "Pesanan #{$order->order_code} dibatalkan.");
    }
}