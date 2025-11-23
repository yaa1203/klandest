<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()->wishlist()->with('kategori')->latest()->get();
        return view('user.wishlist.index', compact('wishlist'));
    }

    public function add(Product $product)
    {
        auth()->user()->wishlist()->attach($product->id);

        return back()->with('success', 'Ditambahkan ke Wishlist!');
    }

    public function remove(Product $product)
    {
        auth()->user()->wishlist()->detach($product->id);

        return back()->with('success', 'Dihapus dari Wishlist');
    }
}