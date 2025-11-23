<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->orders()->with('items')->latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10);

        return view('user.pesanan.index', compact('orders'));
    }

    public function received($code)
    {
        $order = Order::where('order_code', $code)->where('user_id', auth()->id())->firstOrFail();

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum dikirim!');
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Pesanan telah ditandai sebagai selesai. Terima kasih!');
    }
}