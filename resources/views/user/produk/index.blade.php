@extends('user.layouts.app')

@section('title', 'Katalog Produk - Klandest')

@section('content')

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-black via-gray-900 to-black text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-5xl font-bold mb-4">Koleksi Premium Kami</h2>
            <p class="text-xl text-gray-300 mb-8">Temukan gaya terbaik dengan harga terjangkau</p>
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="#produk" class="bg-white text-black px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg">
                    Lihat Produk
                </a>
                <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-green-600 transition shadow-lg flex items-center gap-2">
                    <span>Chat</span>
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="produk" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <!-- Filter Kategori -->
        @if($kategoris->count() > 0)
        <div class="mb-10">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Filter berdasarkan kategori:</h4>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('produk.index') }}"
                   class="px-5 py-2.5 rounded-full font-medium transition-all {{ request('kategori') ? 'bg-gray-200 text-gray-700 hover:bg-gray-300' : 'bg-black text-white' }}">
                    Semua Produk
                </a>
                @foreach($kategoris as $kategori)
                <a href="{{ route('produk.index', ['kategori' => $kategori->id]) }}"
                   class="px-5 py-2.5 rounded-full font-medium transition-all {{ request('kategori') == $kategori->id ? 'bg-black text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ $kategori->nama }}
                    <span class="ml-1 text-xs opacity-75">({{ $kategori->products_count }})</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Section Header -->
        <div class="mb-10 text-center">
            <h3 class="text-4xl font-bold text-gray-900 mb-3">Katalog Produk</h3>
            <p class="text-lg text-gray-600">
                Menampilkan <strong class="text-black">{{ $products->total() }}</strong> produk pilihan untuk Anda
            </p>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
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

                    <!-- Badge Kategori -->
                    @if($product->kategori)
                    <div class="absolute top-4 left-4">
                        <span class="bg-black/80 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                            {{ $product->kategori->nama }}
                        </span>
                    </div>
                    @endif

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

                    <div class="mb-4">
                        <p class="text-3xl font-bold text-black">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </p>
                    </div>

                    @if($product->deskripsi)
                    <p class="text-sm text-gray-600 mb-5 line-clamp-2 min-h-[2.5rem]">
                        {{ Str::limit($product->deskripsi, 80) }}
                    </p>
                    @else
                    <div class="mb-5 h-[2.5rem]"></div>
                    @endif

                    <div class="flex gap-3">
                        <a href="{{ route('produk.show', $product->id) }}"
                           class="flex-1 text-center bg-black hover:bg-gray-900 text-white py-3 rounded-lg font-bold transition-all duration-200 shadow-md hover:shadow-xl">
                            Lihat Detail
                        </a>
                        @auth
                            @if($product->isWishlistedBy(auth()->user()))
                                <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition shadow">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('wishlist.add', $product) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="px-4 py-3 border border-gray-300 rounded-lg hover:bg-red-50 transition">
                                        <i class="far fa-heart text-red-500"></i>
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <i class="far fa-heart text-gray-600"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mb-12">
            {{ $products->links() }}
        </div>

        @else
        <div class="text-center py-20 bg-white rounded-xl shadow-md border border-gray-100">
            <i class="fas fa-shopping-bag text-9xl text-gray-200 mb-6 block"></i>
            <h3 class="text-3xl font-bold text-gray-900 mb-3">Tidak Ada Produk</h3>
            <p class="text-gray-600 text-lg mb-6">
                {{ request('kategori') ? 'Kategori ini belum memiliki produk.' : 'Belum ada produk tersedia saat ini.' }}
            </p>
            <a href="{{ route('produk.index') }}" class="text-black font-medium underline">← Kembali ke semua produk</a>
        </div>
        @endif
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-black to-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-bold mb-4">Ada Pertanyaan? Hubungi Kami!</h3>
            <p class="text-lg text-gray-300 mb-8">Tim kami siap membantu Anda 24/7</p>
            <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-xl font-bold transition shadow-2xl text-lg">
                <span class="text-2xl">Chat</span>
                <span>Chat via WhatsApp</span>
            </a>
        </div>
    </div>

@endsection