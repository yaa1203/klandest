@extends('user.layouts.app')

@section('title', 'Katalog Produk - Klandest')

@section('content')

    <!-- Hero Section - Responsive -->
    <div class="bg-gradient-to-r from-black via-gray-900 to-black text-white py-12 md:py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold mb-3 md:mb-4">Koleksi Premium Kami</h2>
            <p class="text-base md:text-xl text-gray-300 mb-6 md:mb-8 px-4">Temukan gaya terbaik dengan harga terjangkau</p>
            <div class="flex flex-col sm:flex-row justify-center gap-3 md:gap-4 px-4">
                <a href="#produk" class="bg-white text-black px-6 md:px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg text-sm md:text-base">
                    Lihat Produk
                </a>
                <a href="https://wa.me/{{ setting('whatsapp_number', '6281234567890') }}?text={{ urlencode(setting('whatsapp_text', 'Halo Klandest, saya mau tanya tentang produk...')) }}" 
                   target="_blank" 
                   class="bg-green-500 text-white px-6 md:px-8 py-3 rounded-lg font-bold hover:bg-green-600 transition shadow-lg flex items-center justify-center gap-2 text-sm md:text-base">
                    <i class="fab fa-whatsapp"></i>
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="produk" class="max-w-7xl mx-auto px-4 sm:px-6 py-8 md:py-16">

        <!-- Section Header -->
        <div class="mb-6 md:mb-10 text-center">
            <h3 class="text-2xl md:text-4xl font-bold text-gray-900 mb-2 md:mb-3">Katalog Produk</h3>
            <p class="text-sm md:text-lg text-gray-600">
                Menampilkan <strong class="text-black">{{ $products->total() }}</strong> produk pilihan untuk Anda
            </p>
        </div>

        <!-- Products Grid - Responsive -->
        @if($products->count() > 0)
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-6 mb-8 md:mb-12">
            @foreach($products as $product)
            <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-2 border border-gray-100">
                
                <!-- Product Image -->
                <div class="relative h-48 sm:h-56 md:h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                    @if($product->gambar)
                        <img src="{{ asset('storage/'.$product->gambar) }}"
                             alt="{{ $product->nama_produk }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50">
                            <i class="fas fa-image text-3xl md:text-5xl text-gray-300 mb-2"></i>
                            <span class="text-gray-400 font-semibold text-xs md:text-sm">Tidak ada gambar</span>
                        </div>
                    @endif

                    <!-- Badge Terbaru -->
                    <div class="absolute top-2 right-2 md:top-4 md:right-4">
                        <span class="bg-black text-white px-2 py-1 md:px-3 md:py-1.5 rounded-full text-xs font-bold shadow-lg">
                            NEW
                        </span>
                    </div>

                    <!-- Wishlist Button - Mobile Floating -->
                    @auth
                        @if($product->isWishlistedBy(auth()->user()))
                            <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="absolute top-2 left-2 md:top-4 md:left-4 z-10">
                                @csrf @method('DELETE')
                                <button class="w-8 h-8 md:w-10 md:h-10 bg-white rounded-full shadow-lg hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                    <i class="fas fa-heart text-red-500 hover:text-white text-sm md:text-base"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('wishlist.add', $product) }}" method="POST" class="absolute top-2 left-2 md:top-4 md:left-4 z-10">
                                @csrf
                                <button class="w-8 h-8 md:w-10 md:h-10 bg-white rounded-full shadow-lg hover:bg-black hover:text-white transition flex items-center justify-center">
                                    <i class="far fa-heart text-sm md:text-base"></i>
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>

                <!-- Product Info -->
                <div class="p-3 md:p-6">
                    <h4 class="text-sm md:text-lg font-bold text-gray-900 mb-2 md:mb-3 line-clamp-2 group-hover:text-black transition min-h-[2.5rem] md:min-h-[3.5rem]">
                        {{ $product->nama_produk }}
                    </h4>

                    <div class="mb-3 md:mb-4">
                        <p class="text-lg md:text-3xl font-bold text-black">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </p>
                    </div>

                    @if($product->deskripsi)
                    <p class="hidden md:block text-sm text-gray-600 mb-5 line-clamp-2 min-h-[2.5rem]">
                        {{ Str::limit($product->deskripsi, 80) }}
                    </p>
                    @else
                    <div class="hidden md:block mb-5 h-[2.5rem]"></div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-2 md:gap-3">
                        <a href="{{ route('produk.show', $product->id) }}"
                           class="text-center bg-black hover:bg-gray-800 text-white py-2 md:py-3 rounded-lg font-bold transition-all duration-200 shadow-md hover:shadow-xl text-xs md:text-base">
                            Detail
                        </a>
                        <a href="{{ $product->shopee_link }}" 
                           target="_blank"
                           class="text-center bg-orange-500 hover:bg-orange-600 text-white py-2 md:py-3 rounded-lg font-bold transition-all duration-200 shadow-md hover:shadow-xl flex items-center justify-center gap-1 md:gap-2 text-xs md:text-base">
                            <i class="fab fa-shopify text-sm md:text-base"></i>
                            <span>Beli</span>
                        </a>
                    </div>

                    <!-- Wishlist Button - Desktop Only -->
                    <div class="mt-3 hidden md:block">
                        @auth
                            @if($product->isWishlistedBy(auth()->user()))
                                <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="w-full">
                                    @csrf @method('DELETE')
                                    <button class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition shadow flex items-center justify-center gap-2">
                                        <i class="fas fa-heart"></i>
                                        <span class="text-sm font-medium">Hapus dari Wishlist</span>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('wishlist.add', $product) }}" method="POST" class="w-full">
                                    @csrf
                                    <button class="w-full px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center justify-center gap-2">
                                        <i class="far fa-heart text-red-500"></i>
                                        <span class="text-sm font-medium text-gray-700">Tambah ke Wishlist</span>
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="w-full block px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-center">
                                <i class="far fa-heart text-gray-600"></i>
                                <span class="text-sm font-medium text-gray-700">Login untuk Wishlist</span>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mb-8 md:mb-12">
            {{ $products->links() }}
        </div>

        @else
        <!-- Empty State - Responsive -->
        <div class="text-center py-12 md:py-20 bg-white rounded-xl shadow-md border border-gray-100">
            <i class="fas fa-shopping-bag text-6xl md:text-9xl text-gray-200 mb-4 md:mb-6 block"></i>
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2 md:mb-3">Tidak Ada Produk</h3>
            <p class="text-gray-600 text-base md:text-lg mb-4 md:mb-6 px-4">
                Belum ada produk tersedia saat ini.
            </p>
            <a href="{{ route('produk.index') }}" class="text-black font-medium underline text-sm md:text-base">← Kembali ke semua produk</a>
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
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>

@endsection