{{-- resources/views/user/kategori/show.blade.php --}}

@extends('user.layouts.app')

@section('title', $kategori->nama . ' - Klandest')

@section('content')

<!-- Header Kategori -->
<div class="bg-gradient-to-r from-black via-gray-900 to-black text-white py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">{{ $kategori->nama }}</h1>
        @if($kategori->deskripsi)
            <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">{{ $kategori->deskripsi }}</p>
        @endif
        <p class="text-lg text-gray-400 mt-6">
            Menampilkan <strong class="text-white">{{ $products->total() }}</strong> produk keren
        </p>
    </div>
</div>

<!-- Back Button -->
<div class="max-w-7xl mx-auto px-4 py-6">
    <a href="{{ route('kategori.frontend') }}" 
       class="inline-flex items-center gap-2 text-gray-600 hover:text-black font-medium transition">
        <i class="fas fa-chevron-left"></i>
        <span>Kembali ke Semua Kategori</span>
    </a>
</div>

<!-- Products Grid -->
<div class="max-w-7xl mx-auto px-4 pb-20">

    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-2 border border-gray-100">
                    
                    <!-- Product Image -->
                    <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        @if($product->gambar)
                            <img src="{{ asset('storage/'.$product->gambar) }}"
                                 alt="{{ $product->nama_produk }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50">
                                <i class="fas fa-image text-5xl text-gray-300 mb-2"></i>
                                <span class="text-gray-400 font-semibold text-sm">Tidak ada gambar</span>
                            </div>
                        @endif

                        <!-- Badge Kategori (opsional, sudah ada di atas) -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-black/80 text-white px-3 py-1.5 rounded-full text-xs font-bold backdrop-blur-sm">
                                {{ $kategori->nama }}
                            </span>
                        </div>

                        <!-- Badge Terbaru -->
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                                Terbaru
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-black transition min-h-[3.5rem]">
                            {{ $product->nama_produk }}
                        </h4>

                        <!-- Harga -->
                        <div class="mb-4">
                            <p class="text-3xl font-bold text-black">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Deskripsi Singkat -->
                        @if($product->deskripsi)
                            <p class="text-sm text-gray-600 mb-5 line-clamp-2 min-h-[2.5rem]">
                                {{ Str::limit($product->deskripsi, 80) }}
                            </p>
                        @else
                            <div class="mb-5 h-[2.5rem]"></div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('produk.show', $product->id) }}"
                               class="flex-1 text-center bg-black hover:bg-gray-900 text-white py-3 rounded-lg font-bold transition-all duration-200 shadow-md hover:shadow-xl">
                                Lihat Detail
                            </a>
                            <button class="px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="far fa-heart text-lg text-gray-600"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            {{ $products->links() }}
        </div>

    @else
        <!-- Empty State -->
        <div class="text-center py-24 bg-white rounded-2xl shadow-lg border border-gray-100">
            <i class="fas fa-box-open text-9xl text-gray-200 mb-8 block"></i>
            <h3 class="text-3xl font-bold text-gray-900 mb-4">Belum Ada Produk</h3>
            <p class="text-lg text-gray-600 mb-8">
                Kategori <strong>{{ $kategori->nama }}</strong> sedang dalam proses pengisian.
            </p>
            <a href="{{ route('kategori.frontend') }}" 
               class="inline-flex items-center gap-2 bg-black text-white px-8 py-4 rounded-lg font-bold hover:bg-gray-900 transition">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Kategori</span>
            </a>
        </div>
    @endif

</div>

@endsection