@extends('admin.layouts.app')

@section('title', 'Daftar Produk')
@section('page-title', 'Manajemen Produk')

@section('content')

<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Daftar Produk</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola dan monitor semua produk Anda</p>
        </div>
        <a href="{{ route('products.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-6 py-3 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 font-medium text-sm">
            <i class="fas fa-plus"></i>
            <span>Tambah Produk</span>
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-box text-gray-700"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Produk</p>
                <p class="text-2xl font-bold text-gray-900">{{ $products->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center">
                <i class="fab fa-shopify text-orange-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Produk Shopee</p>
                <p class="text-2xl font-bold text-gray-900">{{ $products->whereNotNull('shopee_link')->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    
    <!-- Table Header -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-2">
                <i class="fas fa-list text-gray-600"></i>
                <h3 class="font-semibold text-gray-900">Semua Produk</h3>
                <span class="px-2 py-1 bg-gray-200 text-gray-700 text-xs font-medium rounded-full">
                    {{ $products->total() }}
                </span>
            </div>
            
            <!-- Search & Filter (Optional) -->
            <div class="flex gap-2">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari produk..." 
                           class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Wrapper -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Produk
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Harga
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Link Shopee
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    
                    <!-- Product Info with Image -->
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}"
                                         alt="{{ $item->nama_produk }}"
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-lg"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-gray-900 truncate">{{ $item->nama_produk }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">SKU: {{ $item->sku ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </td>

                    <!-- Price -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-semibold text-gray-900">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                    </td>

                    <!-- Shopee Link -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->shopee_link)
                            <a href="{{ $item->shopee_link }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-orange-50 text-orange-700 border border-orange-200 hover:bg-orange-100 transition-colors">
                                <i class="fab fa-shopify text-xs"></i>
                                <span class="truncate max-w-[150px]">Lihat di Shopee</span>
                            </a>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-600">
                                <i class="fas fa-unlink text-xs mr-1"></i>
                                Tidak Ada Link
                            </span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            
                            <!-- View Button -->
                            <a href="{{ route('products.show', $item->id) }}"
                               class="w-8 h-8 flex items-center justify-center bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors"
                               title="Lihat Detail">
                                <i class="fas fa-eye text-sm"></i>
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('products.edit', $item->id) }}"
                               class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors"
                               title="Edit Produk">
                                <i class="fas fa-edit text-sm"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('products.destroy', $item->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-8 h-8 flex items-center justify-center bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors"
                                        title="Hapus Produk">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-box-open text-4xl text-gray-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-900 font-semibold mb-1">Belum ada produk</p>
                                <p class="text-sm text-gray-500">Klik tombol "Tambah Produk" untuk memulai</p>
                            </div>
                            <a href="{{ route('products.create') }}"
                               class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-6 py-2.5 rounded-lg font-medium text-sm transition-colors">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Produk Pertama</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold text-gray-900">{{ $products->firstItem() }}</span> 
                sampai <span class="font-semibold text-gray-900">{{ $products->lastItem() }}</span> 
                dari <span class="font-semibold text-gray-900">{{ $products->total() }}</span> produk
            </div>
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
    @endif

</div>

<style>
/* Custom pagination styling */
.pagination {
    display: flex;
    gap: 0.25rem;
}

.pagination .page-link {
    padding: 0.5rem 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    color: #374151;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
}

.pagination .page-link:hover {
    background-color: #f9fafb;
    border-color: #d1d5db;
}

.pagination .page-item.active .page-link {
    background-color: #111827;
    border-color: #111827;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: #9ca3af;
    background-color: #f9fafb;
}
</style>

@endsection