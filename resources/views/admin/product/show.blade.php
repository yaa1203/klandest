@extends('admin.layouts.app')

@section('title', 'Detail Produk')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('products.index') }}"
       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
        <span class="text-xl">←</span>
        <span>Kembali ke Daftar Produk</span>
    </a>
</div>

<!-- Main Card -->
<div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
    
    <div class="grid md:grid-cols-2 gap-0">
        
        <!-- Image Section -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 flex items-center justify-center">
            @if($product->gambar)
                <img src="{{ asset('storage/'.$product->gambar) }}"
                     alt="{{ $product->nama_produk }}"
                     class="max-w-full max-h-96 object-contain rounded-lg shadow-xl border-4 border-white">
            @else
                <div class="w-full h-96 bg-gray-200 rounded-lg flex flex-col items-center justify-center border-4 border-dashed border-gray-300">
                    <span class="text-8xl mb-4">📦</span>
                    <span class="text-gray-500 font-medium">Tidak ada gambar</span>
                </div>
            @endif
        </div>

        <!-- Details Section -->
        <div class="p-8 flex flex-col justify-between">
            
            <!-- Product Info -->
            <div>
                <!-- Product Name -->
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ $product->nama_produk }}
                </h1>

                <!-- Price -->
                <div class="mb-6">
                    <p class="text-sm text-gray-500 mb-1">Harga</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-green-600">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- Shopee Link -->
                @if($product->shopee_link)
                <div class="mb-6">
                    <p class="text-sm text-gray-500 mb-2 font-semibold">Link Shopee</p>
                    <a href="{{ $product->shopee_link }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-orange-50 hover:bg-orange-100 text-orange-700 rounded-lg transition-colors font-medium">
                        <i class="fab fa-shopify text-lg"></i>
                        <span>Lihat di Shopee</span>
                        <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                </div>
                @else
                <div class="mb-6">
                    <p class="text-sm text-gray-500 mb-2 font-semibold">Link Shopee</p>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg">
                        <i class="fas fa-unlink"></i>
                        <span>Belum ada link Shopee</span>
                    </div>
                </div>
                @endif

                <!-- Description -->
                @if(isset($product->deskripsi))
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <p class="text-sm text-gray-500 mb-2 font-semibold">Deskripsi</p>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $product->deskripsi }}
                    </p>
                </div>
                @endif

                <!-- SKU (if exists) -->
                @if(isset($product->sku))
                <div class="bg-orange-50 rounded-lg p-4 mb-6">
                    <p class="text-xs text-orange-600 font-semibold mb-1">SKU</p>
                    <p class="text-lg font-bold text-orange-700">{{ $product->sku }}</p>
                </div>
                @endif

                <!-- Timestamps -->
                <div class="space-y-2 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <span>🕐</span>
                        <span>Dibuat: <strong>{{ $product->created_at->isoFormat('D MMMM Y, HH:mm') }}</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>🔄</span>
                        <span>Diperbarui: <strong>{{ $product->updated_at->isoFormat('D MMMM Y, HH:mm') }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mt-8 pt-6 border-t border-gray-200">
                
                <!-- Edit Button -->
                <a href="{{ route('products.edit', $product->id) }}"
                   class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 font-semibold">
                    <span class="text-lg">✏️</span>
                    <span>Edit Produk</span>
                </a>

                <!-- Delete Button -->
                <form action="{{ route('products.destroy', $product->id) }}"
                      method="POST"
                      class="flex-1"
                      onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus produk ini?\n\nProduk: {{ $product->nama_produk }}')">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 font-semibold">
                        <span class="text-lg">🗑️</span>
                        <span>Hapus Produk</span>
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection