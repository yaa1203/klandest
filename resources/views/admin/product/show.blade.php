@extends('admin.layouts.app')

@section('title', 'Detail Produk')
@section('page-title', 'Detail Produk')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('products.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 rounded-lg transition-all shadow-sm hover:shadow">
        <i class="fas fa-arrow-left"></i>
        <span class="font-medium">Kembali ke Daftar Produk</span>
    </a>
</div>

<!-- Main Card -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
        
        <!-- Image Section -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 sm:p-8 lg:p-10 flex items-center justify-center border-b lg:border-b-0 lg:border-r border-gray-200">
            @if($product->gambar)
                <div class="relative group">
                    <img src="{{ asset('storage/'.$product->gambar) }}"
                         alt="{{ $product->nama_produk }}"
                         class="max-w-full max-h-80 sm:max-h-96 object-contain rounded-lg shadow-xl border-4 border-white">
                    <!-- Image Zoom Indicator -->
                    <div class="absolute top-2 right-2 bg-black/50 text-white px-2 py-1 rounded text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fas fa-search-plus mr-1"></i>
                        Klik untuk perbesar
                    </div>
                </div>
            @else
                <div class="w-full h-80 sm:h-96 bg-gray-200 rounded-lg flex flex-col items-center justify-center border-4 border-dashed border-gray-300">
                    <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-image text-5xl text-gray-400"></i>
                    </div>
                    <span class="text-gray-500 font-medium">Tidak ada gambar</span>
                </div>
            @endif
        </div>

        <!-- Details Section -->
        <div class="p-6 sm:p-8 flex flex-col">
            
            <!-- Product Info -->
            <div class="flex-1">
                <!-- Badge & Category (if any) -->
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-semibold border border-blue-200">
                        <i class="fas fa-box"></i>
                        <span>Produk</span>
                    </span>
                    @if($product->shopee_link)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-orange-50 text-orange-700 rounded-full text-xs font-semibold border border-orange-200">
                        <i class="fab fa-shopify"></i>
                        <span>Shopee</span>
                    </span>
                    @endif
                </div>

                <!-- Product Name -->
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $product->nama_produk }}
                </h1>

                <!-- SKU (if exists) -->
                @if(isset($product->sku))
                <div class="mb-4">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-1">SKU</p>
                    <p class="text-sm font-mono font-semibold text-gray-700 bg-gray-100 inline-block px-3 py-1 rounded">
                        {{ $product->sku }}
                    </p>
                </div>
                @endif

                <!-- Price -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Harga</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl sm:text-4xl font-bold text-green-600">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- Description -->
                @if(isset($product->deskripsi) && $product->deskripsi)
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Deskripsi</p>
                    <div class="prose prose-sm max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $product->deskripsi }}</p>
                    </div>
                </div>
                @endif

                <!-- Shopee Link -->
                <div class="mb-6">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Link Produk</p>
                    @if($product->shopee_link)
                        <a href="{{ $product->shopee_link }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 px-4 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-all font-medium shadow-sm hover:shadow-md text-sm">
                            <i class="fab fa-shopify text-lg"></i>
                            <span>Buka di Shopee</span>
                            <i class="fas fa-external-link-alt text-xs"></i>
                        </a>
                    @else
                        <div class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm">
                            <i class="fas fa-unlink"></i>
                            <span>Belum ada link Shopee</span>
                        </div>
                    @endif
                </div>

                <!-- Timestamps -->
                <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Informasi</p>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="far fa-calendar-plus text-gray-400 w-4"></i>
                        <span>Ditambahkan: <strong class="text-gray-900">{{ $product->created_at->format('d M Y, H:i') }} WIB</strong></span>
                    </div>
                    @if($product->updated_at && $product->updated_at != $product->created_at)
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="far fa-calendar-check text-gray-400 w-4"></i>
                        <span>Diupdate: <strong class="text-gray-900">{{ $product->updated_at->format('d M Y, H:i') }} WIB</strong></span>
                    </div>
                    @endif
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="far fa-clock text-gray-400 w-4"></i>
                        <span><strong class="text-gray-900">{{ $product->created_at->diffForHumans() }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 mt-6 pt-6 border-t border-gray-200">
                
                <!-- Edit Button -->
                <a href="{{ route('products.edit', $product->id) }}"
                   class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-5 py-3 rounded-lg shadow-sm hover:shadow-md transition-all font-semibold text-sm">
                    <i class="fas fa-edit"></i>
                    <span>Edit Produk</span>
                </a>

                <!-- Delete Button -->
                <form action="{{ route('products.destroy', $product->id) }}"
                      method="POST"
                      class="flex-1"
                      onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus produk ini?\n\nProduk: {{ $product->nama_produk }}\n\nTindakan ini tidak dapat dibatalkan!')">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-5 py-3 rounded-lg shadow-sm hover:shadow-md transition-all font-semibold text-sm">
                        <i class="fas fa-trash"></i>
                        <span>Hapus Produk</span>
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>

<!-- Additional Info Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    
    <!-- Quick Stats -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                <i class="fas fa-chart-bar text-blue-600"></i>
            </div>
            <h3 class="font-bold text-gray-900">Statistik Produk</h3>
        </div>
        <div class="space-y-3">
            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                <span class="text-sm text-gray-600">Harga Satuan</span>
                <span class="font-semibold text-gray-900">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                <span class="text-sm text-gray-600">Status Link</span>
                @if($product->shopee_link)
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-50 text-green-700 rounded text-xs font-semibold">
                        <i class="fas fa-check-circle"></i>
                        <span>Aktif</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs font-semibold">
                        <i class="fas fa-times-circle"></i>
                        <span>Tidak Ada</span>
                    </span>
                @endif
            </div>
            <div class="flex items-center justify-between py-2">
                <span class="text-sm text-gray-600">Gambar Produk</span>
                @if($product->gambar)
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-50 text-green-700 rounded text-xs font-semibold">
                        <i class="fas fa-check-circle"></i>
                        <span>Tersedia</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-red-50 text-red-600 rounded text-xs font-semibold">
                        <i class="fas fa-times-circle"></i>
                        <span>Kosong</span>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                <i class="fas fa-bolt text-purple-600"></i>
            </div>
            <h3 class="font-bold text-gray-900">Aksi Cepat</h3>
        </div>
        <div class="space-y-2">
            @if($product->shopee_link)
            <a href="{{ $product->shopee_link }}" 
               target="_blank"
               class="flex items-center gap-3 p-3 bg-orange-50 hover:bg-orange-100 border border-orange-200 rounded-lg transition-colors group">
                <i class="fab fa-shopify text-orange-600 text-xl"></i>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-orange-900">Buka di Shopee</p>
                    <p class="text-xs text-orange-700">Lihat produk di toko online</p>
                </div>
                <i class="fas fa-arrow-right text-orange-600 group-hover:translate-x-1 transition-transform"></i>
            </a>
            @endif
            
            <a href="{{ route('products.edit', $product->id) }}"
               class="flex items-center gap-3 p-3 bg-yellow-50 hover:bg-yellow-100 border border-yellow-200 rounded-lg transition-colors group">
                <i class="fas fa-edit text-yellow-600 text-xl"></i>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-yellow-900">Edit Informasi</p>
                    <p class="text-xs text-yellow-700">Ubah detail produk</p>
                </div>
                <i class="fas fa-arrow-right text-yellow-600 group-hover:translate-x-1 transition-transform"></i>
            </a>
            
            <a href="{{ route('products.index') }}"
               class="flex items-center gap-3 p-3 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg transition-colors group">
                <i class="fas fa-th-large text-blue-600 text-xl"></i>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-blue-900">Lihat Semua Produk</p>
                    <p class="text-xs text-blue-700">Kembali ke daftar produk</p>
                </div>
                <i class="fas fa-arrow-right text-blue-600 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>

</div>

<!-- Image Modal (Optional - for zoom functionality) -->
@if($product->gambar)
<div id="imageModal" class="fixed inset-0 bg-black/80 z-50 hidden items-center justify-center p-4" onclick="closeModal()">
    <div class="relative max-w-5xl w-full">
        <button onclick="closeModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 text-xl">
            <i class="fas fa-times"></i> Tutup
        </button>
        <img src="{{ asset('storage/'.$product->gambar) }}"
             alt="{{ $product->nama_produk }}"
             class="w-full h-auto rounded-lg shadow-2xl"
             onclick="event.stopPropagation()">
    </div>
</div>

<script>
// Image zoom functionality
const productImage = document.querySelector('.relative.group img');
const imageModal = document.getElementById('imageModal');

if (productImage && imageModal) {
    productImage.style.cursor = 'pointer';
    productImage.addEventListener('click', function() {
        imageModal.classList.remove('hidden');
        imageModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    });
}

function closeModal() {
    imageModal.classList.add('hidden');
    imageModal.classList.remove('flex');
    document.body.style.overflow = '';
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !imageModal.classList.contains('hidden')) {
        closeModal();
    }
});
</script>
@endif

@endsection