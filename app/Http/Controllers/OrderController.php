<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // Halaman Terima Kasih (untuk COD)
    public function success($code)
    {
        $order = Order::with('items')->where('order_code', $code)->firstOrFail();
        
        return view('user.order.success', compact('order'));
    }

    // Halaman Pembayaran (untuk E-Wallet)
    public function payment($code)
    {
        $order = Order::with('items')->where('order_code', $code)->firstOrFail();
        
        return view('user.order.payment', compact('order'));
    }

    public function uploadProof(Request $request, $code)
    {
        $order = Order::where('order_code', $code)->firstOrFail();

        $request->validate([
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Hapus bukti lama jika ada
        if ($order->bukti_pembayaran) {
            Storage::delete($order->bukti_pembayaran);
        }

        $path = $request->file('bukti')->store('bukti-pembayaran', 'public');

        $order->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'menunggu'
        ]);

        return back()->with('success', 'Bukti transfer berhasil dikirim! Admin akan segera memproses.');
    }
}