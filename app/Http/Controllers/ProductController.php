<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ============================================
    // ADMIN SECTION
    // ============================================
    
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'shopee_link' => 'required|url', // Validasi URL
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'shopee_link.required' => 'Link Shopee wajib diisi',
            'shopee_link.url' => 'Link Shopee harus berupa URL yang valid',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('produk', 'public');
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'shopee_link' => $request->shopee_link,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $gambar,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'shopee_link' => 'required|url',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            $gambar = $request->file('gambar')->store('produk', 'public');
        } else {
            $gambar = $product->gambar;
        }

        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'shopee_link' => $request->shopee_link,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $gambar,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk dihapus');
    }

    // ============================================
    // USER SECTION (KATALOG PRODUK)
    // ============================================
    
    public function catalog(Request $request)
    {
        $query = Product::query();
        $products = $query->latest()->paginate(12)->withQueryString();
        return view('user.produk.index', compact('products'));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('user.produk.show', compact('product'));
    }
}