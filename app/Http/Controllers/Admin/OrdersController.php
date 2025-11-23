<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Daftar semua pesanan admin
     */
    public function index()
    {
        $orders = Order::with(['user', 'items'])
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Approve pembayaran e-wallet (khusus)
     */
    public function approve(Order $order)
    {
        if ($order->metode_pembayaran !== 'cod' && $order->status_pembayaran !== 'diterima') {
            $order->update([
                'status_pembayaran' => 'diterima',
                'status'            => 'confirmed'
            ]);
        } else {
            $order->update(['status' => 'confirmed']);
        }

        return back()->with('success', "Pesanan #{$order->order_code} telah dikonfirmasi!");
    }

    /**
     * Reject pembayaran e-wallet
     */
    public function reject(Order $order)
    {
        $order->update([
            'status_pembayaran' => 'ditolak',
            'status'            => 'canceled'
        ]);

        return back()->with('success', "Pesanan #{$order->order_code} ditolak.");
    }

    /**
     * Tahapan proses pesanan
     */
    public function confirm(Order $order)
    {
        $order->update(['status' => 'confirmed']);
        return back()->with('success', "Pesanan #{$order->order_code} telah dikonfirmasi!");
    }

    public function pack(Order $order)
    {
        $order->update(['status' => 'packed']);
        return back()->with('success', "Pesanan #{$order->order_code} sedang dikemas.");
    }

    public function ship(Order $order)
    {
        $order->update(['status' => 'shipped']);
        return back()->with('success', "Pesanan #{$order->order_code} telah dikirim!");
    }

    public function complete(Order $order)
    {
        $order->update(['status' => 'completed']);
        return back()->with('success', "Pesanan #{$order->order_code} selesai!");
    }

    public function cancel(Order $order)
    {
        $order->update([
            'status'            => 'canceled',
            'status_pembayaran' => 'ditolak' // opsional, biar konsisten
        ]);

        return back()->with('success', "Pesanan #{$order->order_code} dibatalkan.");
    }
}