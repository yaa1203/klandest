@extends('user.layouts.app')
@section('title', 'Klandest - Hidden But Loud')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 md:py-12 px-4 sm:px-6">

        <!-- Hero Section for Guest -->
        <div class="relative bg-gradient-to-br from-black via-gray-900 to-black text-white rounded-2xl md:rounded-3xl p-6 md:p-12 mb-6 md:mb-8 shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-white/5 to-gray-500/10"></div>
            <div class="absolute top-0 right-0 w-40 h-40 md:w-64 md:h-64 bg-white/5 rounded-full -mr-20 md:-mr-32 -mt-20 md:-mt-32"></div>
            <div class="absolute bottom-0 left-0 w-56 h-56 md:w-96 md:h-96 bg-white/5 rounded-full -ml-28 md:-ml-48 -mb-28 md:-mb-48"></div>
            
            <div class="relative z-10 text-center">
                <h1 class="text-3xl md:text-6xl font-bold mb-3 md:mb-4">KLANDEST</h1>
                <p class="text-xl md:text-3xl font-bold mb-2 md:mb-3 tracking-wider">HIDDEN BUT LOUD</p>
                <p class="text-sm md:text-xl text-gray-300 mb-6 md:mb-8 max-w-2xl mx-auto">
                    Temukan koleksi fashion premium dengan desain eksklusif dan kualitas terbaik
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center justify-center gap-2 bg-white text-black px-6 md:px-8 py-3 md:py-4 rounded-lg md:rounded-xl font-bold hover:bg-gray-100 transition text-sm md:text-base shadow-lg">
                        <i class="fas fa-user-plus"></i>
                        <span>Daftar Sekarang</span>
                    </a>
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center justify-center gap-2 bg-transparent text-white border-2 border-white px-6 md:px-8 py-3 md:py-4 rounded-lg md:rounded-xl font-bold hover:bg-white hover:text-black transition text-sm md:text-base">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards - Display Only -->
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-6 mb-6 md:mb-12">
            
            <!-- Total Products -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-md p-4 md:p-8 border-2 border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3 md:mb-4">
                    <div class="w-10 h-10 md:w-14 md:h-14 bg-black rounded-lg md:rounded-xl flex items-center justify-center shadow-lg mb-2 md:mb-0">
                        <i class="fas fa-box text-base md:text-2xl text-white"></i>
                    </div>
                    <span class="hidden md:inline-block text-xs font-semibold text-gray-700 bg-gray-100 px-3 py-1 rounded-full">Products</span>
                </div>
                <p class="text-2xl md:text-5xl font-bold mb-1 md:mb-2 text-black">{{ \App\Models\Product::count() }}</p>
                <p class="text-xs md:text-base text-gray-600 font-medium">Produk Tersedia</p>
            </div>

            <!-- Collections -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-md p-4 md:p-8 border-2 border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3 md:mb-4">
                    <div class="w-10 h-10 md:w-14 md:h-14 bg-black rounded-lg md:rounded-xl flex items-center justify-center shadow-lg mb-2 md:mb-0">
                        <i class="fas fa-tags text-base md:text-2xl text-white"></i>
                    </div>
                    <span class="hidden md:inline-block text-xs font-semibold text-gray-700 bg-gray-100 px-3 py-1 rounded-full">New</span>
                </div>
                <p class="text-2xl md:text-5xl font-bold mb-1 md:mb-2 text-black">{{ \App\Models\Product::where('created_at', '>=', now()->subDays(7))->count() }}</p>
                <p class="text-xs md:text-base text-gray-600 font-medium">Koleksi Terbaru</p>
            </div>

            <!-- Premium Quality -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-md p-4 md:p-8 border-2 border-gray-100 col-span-2 lg:col-span-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3 md:mb-4">
                    <div class="w-10 h-10 md:w-14 md:h-14 bg-black rounded-lg md:rounded-xl flex items-center justify-center shadow-lg mb-2 md:mb-0">
                        <i class="fas fa-award text-base md:text-2xl text-white"></i>
                    </div>
                    <span class="hidden md:inline-block text-xs font-semibold text-gray-700 bg-gray-100 px-3 py-1 rounded-full">Quality</span>
                </div>
                <p class="text-2xl md:text-5xl font-bold mb-1 md:mb-2 text-black">100%</p>
                <p class="text-xs md:text-base text-gray-600 font-medium">Kualitas Premium</p>
            </div>
        </div>

        <!-- NEW ARRIVALS SECTION -->
        <div class="bg-white rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-12 border border-gray-200">
            <div class="text-center mb-6 md:mb-12">
                <span class="inline-block px-4 md:px-6 py-1.5 md:py-2 bg-black text-white text-xs md:text-sm font-bold rounded-full mb-3 md:mb-4">NEW COLLECTION</span>
                <h2 class="text-3xl md:text-5xl font-bold mb-2 md:mb-4 text-black">New Arrivals</h2>
                <p class="text-sm md:text-xl text-gray-600 max-w-2xl mx-auto px-4">Koleksi terbaru yang wajib kamu miliki. Update setiap minggu!</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                @forelse(\App\Models\Product::latest()->take(8)->get() as $product)
                <div class="bg-white rounded-xl md:rounded-2xl shadow-md overflow-hidden group hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-2 border-gray-100 hover:border-black">
                    <div class="relative h-48 sm:h-56 md:h-80 bg-gray-100 overflow-hidden">
                        @if($product->gambar)
                            <img src="{{ asset('storage/'.$product->gambar) }}" 
                                alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <i class="fas fa-tshirt text-4xl md:text-6xl text-gray-300"></i>
                            </div>
                        @endif

                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Login Prompt for Wishlist -->
                        <div class="absolute top-2 right-2 md:top-3 md:right-3 z-10">
                            <a href="{{ route('login') }}" 
                               class="w-8 h-8 md:w-10 md:h-10 bg-white rounded-full shadow-lg hover:bg-black hover:text-white transition flex items-center justify-center"
                               title="Login untuk menambahkan ke wishlist">
                                <i class="far fa-heart text-sm md:text-base"></i>
                            </a>
                        </div>

                        <!-- Badge New -->
                        @if($product->created_at->diffInDays() < 7)
                            <span class="absolute top-2 left-2 md:top-3 md:left-3 bg-black text-white px-2 py-1 md:px-3 md:py-1.5 rounded-full text-xs font-bold shadow-lg z-10">
                                NEW
                            </span>
                        @endif
                    </div>

                    <div class="p-3 md:p-6">
                        <h3 class="font-bold text-sm md:text-lg mb-2 line-clamp-2 min-h-[2.5rem] md:min-h-[3rem] group-hover:text-black transition">{{ $product->nama_produk }}</h3>
                        <div class="flex items-center justify-between mb-3 md:mb-4">
                            <p class="text-base md:text-2xl font-bold text-black">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('produk.show', $product->id) }}" 
                               class="text-center bg-black text-white py-2 md:py-3 rounded-lg md:rounded-xl font-bold hover:bg-gray-800 transition text-xs md:text-sm">
                                Detail
                            </a>
                            <a href="{{ $product->shopee_link }}" 
                               target="_blank"
                               class="text-center bg-orange-500 text-white py-2 md:py-3 rounded-lg md:rounded-xl font-bold hover:bg-orange-600 transition text-xs md:text-sm flex items-center justify-center gap-1 md:gap-2">
                                <i class="fab fa-shopify text-sm md:text-base"></i>
                                <span>Beli</span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-2 lg:col-span-4 text-center py-12 md:py-20">
                        <div class="w-24 h-24 md:w-32 md:h-32 mx-auto mb-4 md:mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-box text-4xl md:text-6xl text-gray-300"></i>
                        </div>
                        <p class="text-lg md:text-2xl text-gray-500 font-semibold">Belum ada produk tersedia</p>
                    </div>
                @endforelse
            </div>

            @if(\App\Models\Product::count() > 8)
            <div class="text-center mt-6 md:mt-12">
                <a href="{{ url('produk') }}" 
                class="inline-flex items-center gap-2 md:gap-3 px-6 md:px-12 py-3 md:py-5 bg-black text-white text-sm md:text-lg font-bold rounded-full hover:shadow-2xl transition-all duration-300 hover:scale-105 hover:bg-gray-800">
                    <span>Lihat Semua Produk</span>
                    <i class="fas fa-arrow-right text-xs md:text-base"></i>
                </a>
            </div>
            @endif
        </div>

        <!-- Call to Action Section -->
        <div class="mt-6 md:mt-12 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl md:rounded-3xl p-6 md:p-12 text-center border-2 border-green-200">
            <div class="max-w-2xl mx-auto">
                <i class="fas fa-shopping-bag text-4xl md:text-6xl text-green-600 mb-4"></i>
                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3 md:mb-4">Siap Berbelanja?</h3>
                <p class="text-sm md:text-lg text-gray-700 mb-6 md:mb-8">
                    Daftar sekarang untuk menikmati fitur lengkap seperti wishlist, keranjang belanja, dan update koleksi terbaru!
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center justify-center gap-2 bg-black text-white px-6 md:px-8 py-3 md:py-4 rounded-lg md:rounded-xl font-bold hover:bg-gray-800 transition text-sm md:text-base shadow-lg">
                        <i class="fas fa-user-plus"></i>
                        <span>Daftar Gratis</span>
                    </a>
                    <a href="https://wa.me/{{ setting('whatsapp_number', '6281234567890') }}?text={{ urlencode('Halo Klandest, saya ingin tanya tentang produk...') }}" 
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2 bg-green-500 text-white px-6 md:px-8 py-3 md:py-4 rounded-lg md:rounded-xl font-bold hover:bg-green-600 transition text-sm md:text-base shadow-lg">
                        <i class="fab fa-whatsapp text-lg md:text-xl"></i>
                        <span>Chat WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    html {
        scroll-behavior: smooth;
    }
    
    @media (max-width: 640px) {
        button, a {
            min-height: 44px;
            min-width: 44px;
        }
    }
</style>
@endsection