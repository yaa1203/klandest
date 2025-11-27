@extends('user.layouts.app')
@section('title', 'Wishlist Saya - Klandest')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <!-- Header -->
    <div class="mb-8 md:mb-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 md:mb-3">Wishlist Saya</h1>
        <p class="text-sm md:text-base lg:text-lg text-gray-600">
            Produk favorit yang kamu simpan untuk dibeli nanti
        </p>
    </div>

    @if($wishlist->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($wishlist as $product)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group border border-gray-200">
                    <!-- Product Image -->
                    <div class="relative aspect-square bg-gray-100">
                        @if($product->gambar)
                            <img src="{{ asset('storage/'.$product->gambar) }}"
                                alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center">
                                <i class="fas fa-image text-4xl md:text-5xl text-gray-300"></i>
                                <span class="text-gray-400 text-xs md:text-sm mt-2">No Image</span>
                            </div>
                        @endif

                        <!-- Remove Button -->
                        {{-- PERBAIKAN: Menambahkan ->id untuk memastikan parameter terkirim --}}
                        <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="absolute top-2 right-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-9 h-9 bg-white hover:bg-red-500 text-red-500 hover:text-white rounded-full shadow-md transition flex items-center justify-center"
                                    onclick="return confirm('Hapus dari wishlist?')">
                                <i class="fas fa-heart text-sm"></i>
                            </button>
                        </form>

                        <!-- Badge Wishlist -->
                        <div class="absolute bottom-2 left-2">
                            <span class="inline-flex items-center gap-1 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                <i class="fas fa-heart text-xs"></i>
                                <span>Favorit</span>
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-3 md:p-4">
                        <h4 class="text-sm md:text-base font-semibold text-gray-900 mb-2 line-clamp-2 min-h-[2.5rem] md:min-h-[3rem]">
                            {{ $product->nama_produk }}
                        </h4>

                        <p class="text-base md:text-lg lg:text-xl font-bold text-gray-900 mb-3 md:mb-4">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </p>

                        <div class="space-y-2">
                            <!-- Lihat Detail -->
                            <a href="{{ route('produk.show', $product->id) }}"
                               class="block w-full text-center bg-gray-900 text-white py-2 md:py-2.5 rounded-lg font-semibold hover:bg-black transition text-xs md:text-sm">
                                Lihat Detail
                            </a>

                            <div class="grid grid-cols-2 gap-2">
                                <!-- Beli di Shopee -->
                                <a href="{{ $product->shopee_link }}" 
                                   target="_blank"
                                   class="flex items-center justify-center gap-1 bg-orange-500 text-white py-2 md:py-2.5 rounded-lg font-semibold hover:bg-orange-600 transition text-xs md:text-sm">
                                    <i class="fab fa-shopify text-sm"></i>
                                    <span>Beli</span>
                                </a>

                                <!-- Tambah ke Keranjang -->
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center justify-center gap-1 bg-green-600 text-white py-2 md:py-2.5 rounded-lg font-semibold hover:bg-green-700 transition text-xs md:text-sm">
                                        <i class="fas fa-shopping-cart text-xs"></i>
                                        <span>Cart</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Clear Wishlist Button -->
        <div class="text-center mt-8 md:mt-12">
            {{-- PERBAIKAN: Mengubah rute dari 'wishlist.remove' menjadi 'wishlist.clear' --}}
            <form action="{{ route('wishlist.clear') }}" method="POST" onsubmit="return confirm('Hapus semua wishlist?')">
                @csrf 
                @method('DELETE')
                <button class="inline-flex items-center gap-2 px-6 md:px-8 py-3 bg-red-600 text-white rounded-lg md:rounded-xl font-bold hover:bg-red-700 transition text-sm md:text-base">
                    <i class="fas fa-trash-alt"></i>
                    <span>Bersihkan Semua Wishlist</span>
                </button>
            </form>
        </div>

    @else
        <!-- Empty State -->
        <div class="text-center py-12 md:py-20 bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200">
            <div class="w-24 h-24 md:w-32 md:h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                <i class="far fa-heart text-5xl md:text-6xl lg:text-7xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2 md:mb-4">Wishlist Kosong</h3>
            <p class="text-sm md:text-base lg:text-lg text-gray-600 mb-6 md:mb-8">Yuk, tambahkan produk favoritmu!</p>
            <a href="{{ route('produk.index') }}" class="inline-flex items-center gap-2 md:gap-3 bg-gray-900 text-white px-8 md:px-10 py-3 md:py-4 rounded-lg md:rounded-xl font-bold text-sm md:text-base hover:bg-black transition">
                <i class="fas fa-shopping-bag"></i>
                <span>Mulai Belanja</span>
            </a>
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

.aspect-square {
    aspect-ratio: 1 / 1;
}
</style>
@endsection