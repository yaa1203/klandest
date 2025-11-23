<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart; // Import facade

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        $total = Cart::getTotal();
        return view('user.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        // Cek apakah ini "Beli Sekarang" (langsung checkout)
        $isBuyNow = $request->has('buy_now');

        // Jika Beli Sekarang → kosongkan keranjang dulu, lalu tambah produk ini saja
        if ($isBuyNow) {
            Cart::clear();
        }

        // Tambahkan produk ke keranjang
        Cart::add([
            'id' => $product->id,
            'name' => $product->nama_produk,
            'price' => $product->harga,
            'quantity' => 1,
            'attributes' => [
                'gambar' => $product->gambar,
            ]
        ]);

        // Arahkan sesuai tombol yang diklik
        if ($isBuyNow) {
            return redirect()->route('checkout.index')
                ->with('success', "Berhasil! {$product->nama_produk} siap di-checkout");
        }

        return redirect()->route('cart.index')
            ->with('success', "{$product->nama_produk} ditambahkan ke keranjang!");
    }

    public function update(Request $request)
    {
        foreach ($request->id as $key => $id) {
            Cart::update($id, ['quantity' => [
                'relative' => false,
                'value' => $request->quantity[$key]
            ]]);
        }
        return back()->with('success', 'Keranjang diperbarui!');
    }

    public function remove($id)
    {
        Cart::remove($id);
        return back()->with('success', 'Item dihapus!');
    }

    public function clear()
    {
        Cart::clear();
        return back()->with('success', 'Keranjang dikosongkan!');
    }
}