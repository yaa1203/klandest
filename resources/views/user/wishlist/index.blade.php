@extends('user.layouts.app')
@section('title', 'Wishlist Saya - Klandest')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-3">Wishlist Saya</h1>
        <p class="text-lg text-gray-600">Produk yang kamu simpan untuk dibeli nanti</p>
    </div>

    @if($wishlist->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($wishlist as $product)
                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100">
                    <div class="relative h-64 bg-gray-50">
                        @if($product->gambar)
                            <img src="{{ asset('storage/'.$product->gambar) }}"
                                alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-100">
                                <i class="fas fa-image text-5xl text-gray-300"></i>
                                <span class="text-gray-400 text-sm mt-2">Tidak ada gambar</span>
                            </div>
                        @endif

                        <!-- Tombol Hapus dari Wishlist -->
                        <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="absolute top-3 right-3 z-10">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-white/90 hover:bg-red-500 text-red-500 hover:text-white p-2.5 rounded-full shadow-lg transition-all duration-200 border border-gray-200"
                                    onclick="return confirm('Hapus dari wishlist?')">
                                <i class="fas fa-heart-broken text-lg"></i>
                            </button>
                        </form>

                        <!-- Badge Kategori (jika pakai relasi category) -->
                        @if($product->category)
                            <div class="absolute top-3 left-3">
                                <span class="bg-black/80 text-white px-3 py-1.5 rounded-full text-xs font-bold backdrop-blur-sm shadow">
                                    {{ $product->category->nama ?? 'Uncategorized' }}
                                </span>
                            </div>
                        @endif

                        <!-- Badge Wishlist (opsional) -->
                        <div class="absolute bottom-3 left-3">
                            <span class="bg-red-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                                <i class="fas fa-heart text-sm"></i> Disimpan
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h4 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 leading-tight">
                            {{ $product->nama_produk }}
                        </h4>

                        <div class="mb-4">
                            <p class="text-2xl font-bold text-black">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </p>
                            @if($product->harga_diskon > 0)
                                <p class="text-sm text-gray-500 line-through">
                                    Rp {{ number_format($product->harga_diskon, 0, ',', '.') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex gap-3">
                            <!-- Lihat Detail -->
                            <a href="{{ route('produk.show', $product->id) }}"
                            class="flex-1 text-center bg-black text-white py-3 rounded-lg font-bold hover:bg-gray-900 transition shadow-sm">
                                Lihat Detail
                            </a>

                            <!-- Tambah ke Keranjang -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                        class="px-5 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow-sm flex items-center justify-center gap-2">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="hidden sm:inline">Keranjang</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol Bersihkan Wishlist -->
        <div class="text-center mt-12">
            <form action="" method="POST" onsubmit="return confirm('Hapus semua wishlist?')">
                @csrf @method('DELETE')
                <button class="px-8 py-3 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 transition">
                    Bersihkan Semua Wishlist
                </button>
            </form>
        </div>

    @else
        <div class="text-center py-20 bg-white rounded-2xl shadow-lg border border-gray-100">
            <i class="far fa-heart text-9xl text-gray-200 mb-6"></i>
            <h3 class="text-3xl font-bold text-gray-900 mb-4">Wishlist Kosong</h3>
            <p class="text-lg text-gray-600 mb-8">Yuk, tambahkan produk favoritmu!</p>
            <a href="{{ route('produk.index') }}" class="inline-flex items-center gap-3 bg-black text-white px-10 py-4 rounded-xl font-bold text-xl hover:bg-gray-800 transition">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection