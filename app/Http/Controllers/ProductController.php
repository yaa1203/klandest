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
        $kategoris = \App\Models\Kategori::all();
        return view('admin.product.create', compact('kategoris'));
    }

    // Di method store()
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required|exists:kategoris,id', // wajib pilih kategori
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('produk', 'public');
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $gambar,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    // ProductController.php

    public function edit(Product $product)
    {
        $kategoris = \App\Models\Kategori::all(); // ambil semua kategori
        return view('admin.product.edit', compact('product', 'kategoris'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'image|mimes:jpg,jpeg,png|max:2048',
            'kategoris_id' => 'required|exists:kategoris,id',
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
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $gambar,
            'kategoris_id' => $request->kategoris_id,
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
    
    // ProductController.php (bagian user)

    public function catalog(Request $request)
    {
        $kategoris = \App\Models\Kategori::withCount('products')->get(); // ambil semua kategori + jumlah produk

        $query = Product::query();

        // Filter berdasarkan kategori (opsional)
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('user.produk.index', compact('products', 'kategoris'));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('user.produk.show', compact('product'));
    }
}