<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('admin.kategori.index', compact('kategoris'))
            ->with('title', 'Daftar Kategori');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create')
            ->with('title', 'Tambah Kategori');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return view('admin.kategori.show', compact('kategori'))
            ->with('title', 'Detail Kategori: ' . $kategori->nama);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'))
            ->with('title', 'Edit Kategori: ' . $kategori->nama);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    // Tambahkan method ini di dalam KategoriController (di paling bawah sebelum penutup class)

    /**
     * Halaman Kategori untuk User (Frontend)
     */
    public function frontend()
    {
        $kategoris = Kategori::withCount('products')
            ->orderBy('nama')
            ->get();

        return view('user.kategoris.index', compact('kategoris'));
    }

    /**
     * Halaman Detail Kategori untuk User (lihat semua produk di kategori ini)
     */
    public function detail($id)
    {
        $kategori = Kategori::with('products')->findOrFail($id);
        
        // Jika ingin paginasi
        $products = $kategori->products()->latest()->paginate(12);

        return view('user.kategoris.show', compact('kategori', 'products'));
    }
}