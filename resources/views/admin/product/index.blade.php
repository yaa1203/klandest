@extends('admin.layouts.app')

@section('title', 'Daftar Produk')

@section('content')

<!-- Success Alert -->
@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 flex items-center gap-3 shadow-sm animate-fade-in">
        <span class="text-2xl">✅</span>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Produk</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola semua produk Anda di sini</p>
        </div>
        <a href="{{ route('products.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 font-medium">
            <span class="text-lg">➕</span>
            <span>Tambah Produk</span>
        </a>
    </div>
</div>

<!-- Table Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    
    <!-- Table Wrapper -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Nama Produk
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-40">
                        Harga
                    </th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-32">
                        Gambar
                    </th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-56">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    
                    <!-- Product Name -->
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">{{ $item->nama_produk }}</div>
                    </td>

                    <!-- Price -->
                    <td class="px-6 py-4">
                        <div class="inline-flex items-center gap-1 bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            <span>Rp</span>
                            <span>{{ number_format($item->harga, 0, ',', '.') }}</span>
                        </div>
                    </td>

                    <!-- Image -->
                    <td class="px-6 py-4">
                        <div class="flex justify-center">
                            @if($item->gambar)
                                <img src="{{ asset('storage/'.$item->gambar) }}"
                                     alt="{{ $item->nama_produk }}"
                                     class="w-16 h-16 object-cover rounded-lg shadow-sm border-2 border-gray-100 hover:scale-110 transition-transform duration-200">
                            @else
                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                                    <span class="text-xs text-gray-400 font-medium">No Image</span>
                                </div>
                            @endif
                        </div>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            
                            <!-- View Button -->
                            <a href="{{ route('products.show', $item->id) }}"
                               class="inline-flex items-center gap-1 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors duration-200 font-medium text-sm">
                                <span>👁️</span>
                                <span>Lihat</span>
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('products.edit', $item->id) }}"
                               class="inline-flex items-center gap-1 px-4 py-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 font-medium text-sm">
                                <span>✏️</span>
                                <span>Edit</span>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('products.destroy', $item->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus produk ini?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center gap-1 px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 font-medium text-sm">
                                    <span>🗑️</span>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <span class="text-6xl">📦</span>
                            <p class="text-gray-500 font-medium">Belum ada produk</p>
                            <p class="text-sm text-gray-400">Klik tombol "Tambah Produk" untuk memulai</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
        {{ $products->links() }}
    </div>
    @endif

</div>

@endsection 