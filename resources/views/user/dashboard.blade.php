@extends('user.layouts.app')
@section('title', 'Dashboard Saya - Klandest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto py-8 md:py-12">

        <!-- Welcome Section with Glass Effect -->
        <div class="relative bg-gradient-to-r from-gray-900 via-black to-gray-900 text-white rounded-3xl p-8 md:p-12 mb-8 shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full -ml-48 -mb-48"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-user text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-5xl font-bold">Halo, {{ $user->name }}!</h1>
                    </div>
                </div>
                <p class="text-lg md:text-xl text-gray-300 max-w-2xl">Selamat datang kembali di dashboard Klandest. Kelola pesanan dan temukan produk terbaru di sini.</p>
            </div>
        </div>

        <!-- Stats Cards with Hover Effects -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-12">
            <!-- Total Orders -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 md:p-8 transition-all duration-300 hover:-translate-y-1 border-2 border-transparent hover:border-black">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-black rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-shopping-bag text-2xl text-white"></i>
                    </div>
                    <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Orders</span>
                </div>
                <p class="text-4xl md:text-5xl font-bold mb-2 bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">{{ $totalOrders }}</p>
                <p class="text-sm md:text-base text-gray-600 font-medium">Total Pesanan</p>
            </div>

            <!-- Total Spent -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 md:p-8 transition-all duration-300 hover:-translate-y-1 border-2 border-transparent hover:border-green-600">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                        <i class="fas fa-wallet text-2xl text-white"></i>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">Spending</span>
                </div>
                <p class="text-2xl md:text-3xl font-bold mb-2 text-green-600">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                <p class="text-sm md:text-base text-gray-600 font-medium">Total Belanja</p>
            </div>

            <!-- Wishlist -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 md:p-8 transition-all duration-300 hover:-translate-y-1 border-2 border-transparent hover:border-red-500 sm:col-span-2 lg:col-span-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-pink-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                        <i class="fas fa-heart text-2xl text-white"></i>
                    </div>
                    <span class="text-xs font-semibold text-red-600 bg-red-50 px-3 py-1 rounded-full">Favorites</span>
                </div>
                <p class="text-4xl md:text-5xl font-bold mb-2 bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">{{ auth()->user()->wishlist()->count() }}</p>
                <p class="text-sm md:text-base text-gray-600 font-medium">Wishlist Saya</p>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8 md:mb-12">
            <div class="bg-gradient-to-r from-gray-900 to-black text-white p-6 md:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-2">Pesanan Terbaru</h3>
                        <p class="text-gray-300 text-sm md:text-base">Pantau status pesanan kamu di sini</p>
                    </div>
                    @if($myOrders->count() > 0)
                    <a href="/pesanan" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-black rounded-xl font-bold hover:bg-gray-100 transition text-sm md:text-base whitespace-nowrap">
                        <span>Semua Pesanan</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    @endif
                </div>
            </div>
            
            <div class="p-4 md:p-8">
                @if($myOrders->count() > 0)
                    <div class="space-y-4">
                        @foreach($myOrders as $order)
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 p-4 md:p-6 border-2 border-gray-100 rounded-xl hover:border-black hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-receipt text-white"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-lg md:text-xl mb-1">#{{ $order->order_code }}</p>
                                    <p class="text-sm text-gray-500 flex items-center gap-2">
                                        <i class="far fa-calendar"></i>
                                        {{ $order->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex flex-row md:flex-col items-center md:items-end gap-3 md:gap-2 ml-16 md:ml-0">
                                <p class="font-bold text-xl md:text-2xl flex-1 md:flex-none">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                <span class="px-4 py-2 text-xs md:text-sm font-bold rounded-full whitespace-nowrap
                                    {{ $order->status == 'pending' ? 'bg-orange-100 text-orange-700 border-2 border-orange-200' : 
                                       ($order->status == 'success' ? 'bg-green-100 text-green-700 border-2 border-green-200' : 'bg-gray-100 border-2 border-gray-200') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 md:py-20">
                        <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-box-open text-6xl text-gray-300"></i>
                        </div>
                        <h4 class="text-xl md:text-2xl font-bold mb-3 text-gray-800">Belum Ada Pesanan</h4>
                        <p class="text-base md:text-lg text-gray-600 mb-8 max-w-md mx-auto">Mulai belanja sekarang dan temukan produk favorit kamu</p>
                        <a href="{{ url('produk') }}" class="inline-flex items-center gap-3 px-8 md:px-12 py-4 bg-black text-white rounded-xl font-bold hover:bg-gray-900 transition shadow-xl text-sm md:text-base">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Mulai Belanja Sekarang</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- NEW ARRIVALS SECTION -->
        <div class="bg-white rounded-3xl shadow-xl p-6 md:p-12 border border-gray-200">
            <div class="text-center mb-8 md:mb-12">
                <span class="inline-block px-6 py-2 bg-black text-white text-sm font-bold rounded-full mb-4">NEW COLLECTION</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-gray-900 via-black to-gray-700 bg-clip-text text-transparent">New Arrivals</h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">Koleksi terbaru yang wajib kamu miliki. Update setiap minggu!</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @forelse(\App\Models\Product::latest()->take(8)->get() as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-2 border-gray-100 hover:border-black">
                    <div class="relative h-64 md:h-80 bg-gray-100 overflow-hidden">
                        @if($product->gambar)
                            <img src="{{ asset('storage/'.$product->gambar) }}" 
                                alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <i class="fas fa-tshirt text-5xl md:text-6xl text-gray-300"></i>
                            </div>
                        @endif

                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Wishlist Button -->
                        @auth
                            @if($product->isWishlistedBy(auth()->user()))
                                <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="absolute top-3 right-3 z-10">
                                    @csrf @method('DELETE')
                                    <button class="w-10 h-10 bg-white rounded-full shadow-lg hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                        <i class="fas fa-heart text-red-500"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('wishlist.add', $product) }}" method="POST" class="absolute top-3 right-3 z-10">
                                    @csrf
                                    <button class="w-10 h-10 bg-white rounded-full shadow-lg hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth

                        <!-- Badge New -->
                        @if($product->created_at->diffInDays() < 7)
                            <span class="absolute top-3 left-3 bg-black text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg z-10">
                                NEW
                            </span>
                        @endif
                    </div>

                    <div class="p-4 md:p-6">
                        <h3 class="font-bold text-base md:text-lg mb-2 line-clamp-2 min-h-[3rem] group-hover:text-black transition">{{ $product->nama_produk }}</h3>
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-xl md:text-2xl font-bold text-black">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex gap-2 md:gap-3">
                            <a href="{{ route('produk.show', $product->id) }}" 
                            class="flex-1 text-center bg-gray-900 text-white py-2.5 md:py-3 rounded-xl font-bold hover:bg-black transition text-sm md:text-base">
                                Detail
                            </a>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button class="w-10 h-10 md:w-12 md:h-12 bg-green-600 text-white rounded-xl hover:bg-green-700 transition flex items-center justify-center shadow-lg">
                                    <i class="fas fa-shopping-cart text-sm md:text-base"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-full text-center py-16 md:py-20">
                        <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-box text-6xl text-gray-300"></i>
                        </div>
                        <p class="text-xl md:text-2xl text-gray-500 font-semibold">Belum ada produk tersedia</p>
                    </div>
                @endforelse
            </div>

            @if(\App\Models\Product::count() > 8)
            <div class="text-center mt-8 md:mt-12">
                <a href="{{ url('produk') }}" 
                class="inline-flex items-center gap-3 px-8 md:px-12 py-4 md:py-5 bg-gradient-to-r from-gray-900 to-black text-white text-base md:text-lg font-bold rounded-full hover:shadow-2xl transition-all duration-300 hover:scale-105">
                    <span>Lihat Semua Produk</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @endif
        </div>

    </div>
</div>

<style>
    @media (max-width: 640px) {
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    }
</style>
@endsection