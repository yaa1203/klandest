@extends('admin.layouts.app')

@section('title', 'Daftar Produk')
@section('page-title', 'Manajemen Produk')

@section('content')

<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Daftar Produk</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola dan monitor semua produk Anda</p>
        </div>
        <a href="{{ route('products.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 font-medium text-sm">
            <i class="fas fa-plus"></i>
            <span>Tambah Produk</span>
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-box text-blue-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Produk</p>
                <p class="text-2xl font-bold text-gray-900">{{ $products->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fab fa-shopify text-orange-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Produk Shopee</p>
                <p class="text-2xl font-bold text-gray-900">{{ $products->whereNotNull('shopee_link')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:col-span-2 lg:col-span-1">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-chart-line text-green-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Nilai Total Stok</p>
                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($products->sum('harga'), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Desktop Table View -->
<div class="hidden lg:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    
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
            
            <!-- Search -->
            <div class="relative w-full sm:w-64">
                <input type="text" 
                       id="searchInput"
                       placeholder="Cari produk..." 
                       class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
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
            <tbody class="divide-y divide-gray-100" id="productTable">
                @forelse($products as $item)
                <tr class="hover:bg-gray-50 transition-colors product-row" data-name="{{ strtolower($item->nama_produk) }}">
                    
                    <!-- Product Info with Image -->
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}"
                                         alt="{{ $item->nama_produk }}"
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-gray-900 mb-1">{{ $item->nama_produk }}</p>
                                <p class="text-xs text-gray-500">SKU: {{ $item->sku ?? 'N/A' }}</p>
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
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-orange-50 text-orange-700 border border-orange-200 hover:bg-orange-100 transition-colors">
                                <i class="fab fa-shopify"></i>
                                <span>Lihat di Shopee</span>
                            </a>
                        @else
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-gray-100 text-gray-600">
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
                               class="w-9 h-9 flex items-center justify-center bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors"
                               title="Lihat Detail">
                                <i class="fas fa-eye text-sm"></i>
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('products.edit', $item->id) }}"
                               class="w-9 h-9 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors"
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
                                        class="w-9 h-9 flex items-center justify-center bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors"
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

<!-- Mobile Card View -->
<div class="lg:hidden space-y-4">
    
    <!-- Search Bar Mobile -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="relative">
            <input type="text" 
                   id="searchInputMobile"
                   placeholder="Cari produk..." 
                   class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
        </div>
    </div>

    <!-- Product Cards -->
    <div id="productCardsMobile">
        @forelse($products as $item)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-4 product-card" data-name="{{ strtolower($item->nama_produk) }}">
            
            <!-- Product Image & Info -->
            <div class="p-4">
                <div class="flex gap-4">
                    <!-- Image -->
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                        @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}"
                                 alt="{{ $item->nama_produk }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $item->nama_produk }}</h3>
                        <p class="text-xs text-gray-500 mb-2">SKU: {{ $item->sku ?? 'N/A' }}</p>
                        <div class="text-lg font-bold text-gray-900">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shopee Link -->
            @if($item->shopee_link)
            <div class="px-4 pb-3">
                <a href="{{ $item->shopee_link }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="flex items-center justify-center gap-2 w-full px-4 py-2 rounded-lg text-sm font-medium bg-orange-50 text-orange-700 border border-orange-200 hover:bg-orange-100 transition-colors">
                    <i class="fab fa-shopify"></i>
                    <span>Lihat di Shopee</span>
                </a>
            </div>
            @endif

            <!-- Actions -->
            <div class="px-4 pb-4 pt-2 flex gap-2 border-t border-gray-100">
                
                <!-- View Button -->
                <a href="{{ route('products.show', $item->id) }}"
                   class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors font-medium text-sm">
                    <i class="fas fa-eye"></i>
                    <span>Detail</span>
                </a>

                <!-- Edit Button -->
                <a href="{{ route('products.edit', $item->id) }}"
                   class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium text-sm">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>

                <!-- Delete Button -->
                <form action="{{ route('products.destroy', $item->id) }}"
                      method="POST"
                      class="flex-1"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors font-medium text-sm">
                        <i class="fas fa-trash"></i>
                        <span>Hapus</span>
                    </button>
                </form>
            </div>

        </div>
        @empty
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <div class="flex flex-col items-center gap-4 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-box-open text-4xl text-gray-400"></i>
                </div>
                <div>
                    <p class="text-gray-900 font-semibold mb-1">Belum ada produk</p>
                    <p class="text-sm text-gray-500 mb-4">Klik tombol "Tambah Produk" untuk memulai</p>
                </div>
                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-6 py-2.5 rounded-lg font-medium text-sm transition-colors">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Produk Pertama</span>
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination Mobile -->
    @if($products->hasPages())
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="text-sm text-gray-600 text-center mb-3">
            Menampilkan <span class="font-semibold text-gray-900">{{ $products->firstItem() }}</span> 
            sampai <span class="font-semibold text-gray-900">{{ $products->lastItem() }}</span> 
            dari <span class="font-semibold text-gray-900">{{ $products->total() }}</span> produk
        </div>
        <div class="flex justify-center">
            {{ $products->links() }}
        </div>
    </div>
    @endif

</div>

<style>
/* Line clamp utility */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Custom pagination styling */
.pagination {
    display: flex;
    gap: 0.25rem;
    flex-wrap: wrap;
    justify-content: center;
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

@media (max-width: 640px) {
    .pagination .page-link {
        padding: 0.375rem 0.625rem;
        font-size: 0.8125rem;
    }
}
</style>

<script>
// Search functionality for Desktop
const searchInput = document.getElementById('searchInput');
const productRows = document.querySelectorAll('.product-row');

if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        
        productRows.forEach(row => {
            const productName = row.getAttribute('data-name');
            if (productName.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
}

// Search functionality for Mobile
const searchInputMobile = document.getElementById('searchInputMobile');
const productCards = document.querySelectorAll('.product-card');

if (searchInputMobile) {
    searchInputMobile.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        
        productCards.forEach(card => {
            const productName = card.getAttribute('data-name');
            if (productName.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
}
</script>

@endsection