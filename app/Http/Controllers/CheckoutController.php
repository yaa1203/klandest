<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Cart::isEmpty()) {
            return redirect()->route('produk.catalog')
                ->with('error', 'Keranjang belanja kosong!');
        }

        $user = auth()->user();
        return view('user.checkout.index', compact('user'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'nama'              => 'required|string|max:255',
            'no_hp'             => 'required|regex:/^08[0-9]{8,11}$/',
            'alamat'            => 'required|string',
            'metode_pembayaran' => 'required|in:cod,ovo,dana,gopay',
            'catatan'           => 'nullable|string|max:500',
        ], [
            'no_hp.regex' => 'Nomor HP harus diawali 08 dan berisi 10–13 angka.',
        ]);

        // Simpan order ke database
        $order = \DB::transaction(function () use ($request) {
            $order = Order::create([
                'user_id'           => auth()->check() ? auth()->id() : null,
                'order_code'        => 'KL' . strtoupper(Str::random(8)),
                'nama_penerima'     => $request->nama,
                'no_hp'             => $request->no_hp,
                'alamat'            => $request->alamat,
                'metode_pembayaran' => $request->metode_pembayaran,
                'catatan'           => $request->catatan,
                'total'             => Cart::getTotal(),
                'status'            => 'pending',
            ]);

            foreach (Cart::getContent() as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->id,
                    'nama_produk'  => $item->name,
                    'harga'        => $item->price,
                    'quantity'     => $item->quantity,
                    'subtotal'     => $item->getPriceSum(),
                ]);
            }

            Cart::clear();
            return $order;
        });

        // Tentukan halaman tujuan berdasarkan metode pembayaran
        if ($request->metode_pembayaran === 'cod') {
            return redirect()->route('order.success', $order->order_code)
                ->with('success', 'Pesanan COD berhasil dibuat!');
        } else {
            return redirect()->route('order.payment', $order->order_code)
                ->with('info', 'Silakan selesaikan pembayaran untuk melanjutkan pesanan.');
        }
    }
}