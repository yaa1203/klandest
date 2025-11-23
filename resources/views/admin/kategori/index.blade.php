@extends('admin.layouts.app')

@section('title', 'Daftar Kategori')
@section('page-title', 'Manajemen Kategori')

@section('content')

<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Daftar Kategori</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola kategori produk Anda</p>
        </div>
        <a href="{{ route('kategori.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-6 py-3 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 font-medium text-sm">
            <i class="fas fa-plus"></i>
            <span>Tambah Kategori</span>
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                <i class="fas fa-tags text-blue-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Kategori</p>
                <p class="text-2xl font-bold text-gray-900">{{ $kategoris->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center">
                <i class="fas fa-box text-green-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Produk Terkategori</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Product::whereNotNull('kategori_id')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center">
                <i class="fas fa-layer-group text-orange-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Kategori Aktif</p>
                <p class="text-2xl font-bold text-gray-900">{{ $kategoris->where('is_active', true)->count() }}</p>
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
                <h3 class="font-semibold text-gray-900">Semua Kategori</h3>
                <span class="px-2 py-1 bg-gray-200 text-gray-700 text-xs font-medium rounded-full">
                    {{ $kategoris->total() }}
                </span>
            </div>
            
            <!-- Search (Optional) -->
            <div class="relative">
                <input type="text" 
                       placeholder="Cari kategori..." 
                       class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            </div>
        </div>
    </div>

    <!-- Table Wrapper -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-20">
                        No
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Nama Kategori
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Deskripsi
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-32">
                        Produk
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-40">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($kategoris as $index => $kategori)
                    <tr class="hover:bg-gray-50 transition-colors">
                        
                        <!-- Number -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                <span class="text-sm font-semibold text-gray-700">{{ $kategoris->firstItem() + $index }}</span>
                            </div>
                        </td>

                        <!-- Category Name with Icon -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-tag text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $kategori->nama }}</p>
                                    <p class="text-xs text-gray-500">ID: {{ $kategori->id }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Description -->
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ $kategori->deskripsi ?: 'Tidak ada deskripsi' }}
                            </p>
                        </td>

                        <!-- Product Count -->
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold 
                                {{ $kategori->products->count() > 0 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                <i class="fas fa-box text-xs"></i>
                                {{ $kategori->products->count() }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                
                                <!-- Edit Button -->
                                <a href="{{ route('kategori.edit', $kategori) }}"
                                   class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors"
                                   title="Edit Kategori">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('kategori.destroy', $kategori) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Produk terkait akan kehilangan kategorinya.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-8 h-8 flex items-center justify-center bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors"
                                            title="Hapus Kategori">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-tags text-4xl text-gray-400"></i>
                                </div>
                                <div>
                                    <p class="text-gray-900 font-semibold mb-1">Belum ada kategori</p>
                                    <p class="text-sm text-gray-500">Klik tombol "Tambah Kategori" untuk memulai</p>
                                </div>
                                <a href="{{ route('kategori.create') }}"
                                   class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-6 py-2.5 rounded-lg font-medium text-sm transition-colors">
                                    <i class="fas fa-plus"></i>
                                    <span>Tambah Kategori Pertama</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($kategoris->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold text-gray-900">{{ $kategoris->firstItem() }}</span> 
                sampai <span class="font-semibold text-gray-900">{{ $kategoris->lastItem() }}</span> 
                dari <span class="font-semibold text-gray-900">{{ $kategoris->total() }}</span> kategori
            </div>
            <div>
                {{ $kategoris->links() }}
            </div>
        </div>
    </div>
    @endif

</div>

<style>
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