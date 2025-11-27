@extends('user.layouts.app')
@section('title', 'Keranjang Belanja - Klandest')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-6 md:py-12">

    <!-- Header -->
    <div class="text-center mb-6 md:mb-10">
        <h1 class="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-2 md:mb-3">Keranjang Belanja</h1>
        <p class="text-sm md:text-lg text-gray-600">
            Kamu memiliki <strong class="text-black">{{ Cart::getTotalQuantity() }}</strong> item tersimpan
        </p>
    </div>

    <!-- Info Banner -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg md:rounded-xl p-3 md:p-5 mb-4 md:mb-8">
        <div class="flex items-start gap-2 md:gap-3">
            <i class="fas fa-info-circle text-black text-lg md:text-2xl mt-0.5 flex-shrink-0"></i>
            <div class="flex-1 min-w-0">
                <h4 class="font-bold text-gray-900 mb-1 text-xs md:text-base">Tentang Keranjang</h4>
                <p class="text-xs md:text-sm text-gray-700 leading-relaxed">
                    Keranjang digunakan untuk menyimpan produk favorit Anda. 
                    Untuk melakukan pembelian, klik <strong>"Beli di Shopee"</strong> pada masing-masing produk di bawah.
                </p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 md:mb-8 p-3 md:p-5 bg-green-50 border border-green-200 rounded-lg md:rounded-xl text-green-700 text-center font-medium text-xs md:text-base">
            {{ session('success') }}
        </div>
    @endif

    @if(Cart::isEmpty())
        <div class="text-center py-10 md:py-20 bg-gray-50 rounded-xl md:rounded-2xl">
            <div class="w-20 h-20 md:w-32 md:h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                <i class="fas fa-shopping-cart text-4xl md:text-7xl text-gray-400"></i>
            </div>
            <h3 class="text-xl md:text-3xl font-bold text-gray-900 mb-2 md:mb-4">Keranjang Kosong</h3>
            <p class="text-xs md:text-base text-gray-600 mb-4 md:mb-8 px-4">Yuk isi keranjangmu dengan koleksi terbaru!</p>
            <a href="{{ url('produk') }}" class="inline-flex items-center gap-2 bg-black text-white px-6 md:px-10 py-2.5 md:py-4 rounded-lg md:rounded-xl font-bold text-sm md:text-base hover:bg-gray-800 transition">
                <i class="fas fa-shopping-bag"></i>
                <span>Mulai Belanja</span>
            </a>
        </div>
    @else
        <!-- Product List -->
        <div class="space-y-3 md:space-y-6 mb-4 md:mb-8">
            @foreach(Cart::getContent() as $item)
                <div class="bg-white rounded-lg md:rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                    <div class="p-3 md:p-6">
                        <div class="flex gap-3 md:gap-6">
                            <!-- Image -->
                            <div class="w-24 h-24 md:w-32 md:h-32 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                @if($item->attributes->gambar)
                                    <img src="{{ asset('storage/' . $item->attributes->gambar) }}" 
                                         alt="{{ $item->name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-tshirt text-2xl md:text-4xl text-gray-300"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2 mb-2 md:mb-3">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm md:text-lg lg:text-xl font-bold text-gray-900 mb-1 md:mb-2 line-clamp-2">
                                            {{ $item->name }}
                                        </h4>
                                        <p class="text-base md:text-2xl font-bold text-black">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <!-- Delete Button -->
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="w-8 h-8 md:w-10 md:h-10 bg-red-50 hover:bg-red-500 hover:text-white text-red-600 rounded-lg transition flex items-center justify-center flex-shrink-0" 
                                                onclick="return confirm('Hapus item ini dari keranjang?')">
                                            <i class="fas fa-trash-alt text-xs md:text-sm"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ $item->attributes->shopee_link ?? '#' }}" 
                                   target="_blank"
                                   class="inline-flex items-center justify-center gap-1.5 md:gap-2 bg-orange-500 hover:bg-orange-600 text-white px-4 md:px-6 py-2 md:py-3 rounded-lg font-bold transition text-xs md:text-base">
                                    <i class="fab fa-shopify text-sm md:text-base"></i>
                                    <span>Beli di Shopee</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Summary Card -->
        <div class="bg-gradient-to-br from-black to-gray-900 text-white rounded-lg md:rounded-2xl shadow-xl p-4 md:p-8">
            <h3 class="text-lg md:text-2xl font-bold mb-4 md:mb-8 text-center">Ringkasan Keranjang</h3>

            <div class="space-y-2 md:space-y-4 mb-4 md:mb-8">
                <div class="flex justify-between text-xs md:text-lg">
                    <span>Total Item</span>
                    <span class="font-bold">{{ Cart::getTotalQuantity() }} item</span>
                </div>
                <div class="flex justify-between text-sm md:text-lg">
                    <span>Estimasi Total</span>
                    <span class="font-bold text-base md:text-2xl">Rp {{ number_format(Cart::getTotal(), 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="space-y-2 md:space-y-3">
                <a href="{{ url('produk') }}" 
                   class="block w-full bg-white text-gray-900 text-center py-2.5 md:py-4 rounded-lg md:rounded-xl font-bold text-xs md:text-base hover:bg-gray-100 transition">
                    <i class="fas fa-plus-circle mr-1 md:mr-2"></i>
                    Tambah Produk Lain
                </a>

                <form action="{{ route('cart.clear') }}" method="POST" class="text-center">
                    @csrf
                    <button type="submit" 
                            class="text-gray-400 hover:text-white transition text-xs md:text-sm py-2"
                            onclick="return confirm('Kosongkan semua item di keranjang?')">
                        Kosongkan Keranjang
                    </button>
                </form>
            </div>

            <div class="mt-4 md:mt-8 pt-4 md:pt-8 border-t border-white/20">
                <p class="text-xs md:text-sm text-center text-gray-400 leading-relaxed">
                    <i class="fas fa-info-circle mr-1"></i>
                    Harga dan ketersediaan produk dapat berubah di Shopee. 
                    Klik "Beli di Shopee" untuk info terbaru.
                </p>
            </div>
        </div>

        <!-- Quick Buy All Section -->
        <div class="mt-4 md:mt-8 bg-green-50 border border-green-200 rounded-lg md:rounded-xl p-4 md:p-8 text-center">
            <h4 class="text-base md:text-xl font-bold text-gray-900 mb-2">Ingin Beli Semua Sekaligus?</h4>
            <p class="text-xs md:text-base text-gray-600 mb-3 md:mb-4 px-2">
                Hubungi kami via WhatsApp untuk pembelian grosir atau bundle
            </p>
            <a href="https://wa.me/6281234567890?text=Halo%20Klandest!%20Saya%20tertarik%20membeli%20beberapa%20produk%20dari%20keranjang%20saya" 
               target="_blank"
               class="inline-flex items-center gap-1.5 md:gap-2 bg-green-500 hover:bg-green-600 text-white px-5 md:px-8 py-2.5 md:py-4 rounded-lg md:rounded-xl font-bold text-xs md:text-base transition">
                <i class="fab fa-whatsapp text-base md:text-xl"></i>
                <span>Chat via WhatsApp</span>
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
</style>
@endsection